<?php
/**
 * $Id: opensim.php 4 2008-10-22 19:09:18Z sdague $
 *
 * Author: Sean Dague, sdague@gmail.com
 * Project: OpenSim Plugin for Serverstats, http://forge.opensimulator.org/gf/project/serverstats/
 * License: BSD Revised 
 *
 * Copyright (C) 2008 Sean Dague
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the OpenSim Project nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE DEVELOPERS ``AS IS'' AND ANY EXPRESS OR
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 * GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER
 * IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


class opensimgrid extends source implements source_cached, source_rrd
{
    private $cpuStats;
    private $oldCpuStats;

    private $GRID = 0;
    private $USER = 1;
    private $ASSET = 2;
    private $INV = 3;
    private $MSG = 4;
    private $ps_find;
    private $pids;
    private $names;
    
    public function __construct()
    {
        $this->ps_find = array();
        $this->pids = array();
        $this->names = array();
        $this->cpuStats = array();
        $this->cpuOldStats = array();
        $this->ps_find[$this->GRID] = "ps auxw | grep OpenSim.Grid.GridServer.exe | grep -v grep | grep -vi screen";
        $this->ps_find[$this->USER] = "ps auxw | grep OpenSim.Grid.UserServer.exe | grep -v grep | grep -vi screen";
        $this->ps_find[$this->ASSET] = "ps auxw | grep OpenSim.Grid.AssetServer.exe | grep -v grep | grep -vi screen";
        $this->ps_find[$this->INV] = "ps auxw | grep OpenSim.Grid.InventoryServer.exe | grep -v grep | grep -vi screen";
        $this->ps_find[$this->MSG] = "ps auxw | grep OpenSim.Grid.MessagingServer.exe | grep -v grep | grep -vi screen";
        $this->names[$this->GRID] = "grid";
        $this->names[$this->USER] = "user";
        $this->names[$this->ASSET] = "asset";
        $this->names[$this->INV] = "inv";
        $this->names[$this->MSG] = "msg";

    }
	
    public function refreshData()
    {
        $this->getStats();
    }

    public function getPids()
    {
        # print_r($this->ps_find);
        for ($i = 0; $i < 5; $i++) 
        {
            $out = "";
            $return = 0;
# first we need to figure out the opensim process id
            exec($this->ps_find[$i], $out, $return);
            if ($return !== 0)
            {
                $this->pids[$i] = 0; 
                throw new Exception('Could not execute "' . $this->ps_find[$i]. '"');
            } else {
                $outarray = preg_split("/ +/", $out[0]);
                $this->pids[$i] = $outarray[1];
            }
        }
    }

    public function getJiffies()
    {
        # get the total jiffies time
        $data = "";
        $file = "/proc/timer_list";
        $fh = fopen($file, 'r');
        while (! preg_match('/jiffies:/', $data)) {
            $data = fgets($fh);
        }
        $fields = preg_split("/ +/", $data);
        return $fields[1];
    }

    public function getStats()
    {
        # collect relevant pids
        $this->getPids();

        # print_r($this->pids);

        for ($i = 0; $i < 5; $i++) 
        {
        # get the process stats out of it
            $pid = $this->pids[$i];
            $file = "/proc/$pid/stat";
            $fh = fopen($file, 'r');
            $data = fgets($fh);
            fclose($fh);
            $pref = $this->names[$i];

            $fields = preg_split("/ +/", $data);
            $this->cpuStats[$pref . "_threads"] = $fields[19]; // threads
            $this->cpuStats[$pref . "_virt"] = $fields[22]; // virt
            $this->cpuStats[$pref . "_real"] = $fields[23] * 4000; // real
            $this->cpuStats[$pref . "_cpu_user"] = $fields[13]; // user
            $this->cpuStats[$pref . "_cpu_sys"] = $fields[14]; // sys
            $this->cpuStats[$pref . "_jiffies"] = $this->getJiffies();
        }

//         $this->mono_threads = $fields[19];
//         $this->mono_virt = $fields[22];
//         $this->mono_real = $fields[23] * 4000;
//         $this->cpuStats[1] = $fields[13];
//         $this->cpuStats[2] = $fields[14];
    }
    
    public function initRRD(rrd $rrd)
    {
        for ($i = 0; $i < 5; $i++) 
        {
            $pref = $this->names[$i];
            $rrd->addDatasource($pref . "_threads", 'GAUGE', null, 0);
            $rrd->addDatasource($pref . "_virt", 'GAUGE', null, 0);
            $rrd->addDatasource($pref . "_real", 'GAUGE', null, 0);
            $rrd->addDatasource($pref . "_cpu_user", 'GAUGE', null, 0);
            $rrd->addDatasource($pref . "_cpu_sys", 'GAUGE', null, 0);            
        }
    }
	
    public function fetchValues()
    {
        $values = array();
        for ($i = 0; $i < 5; $i++) 
        {
            $pref = $this->names[$i];
            $values[$pref . "_threads"] = $this->cpuStats[$pref . "_threads"];
            $values[$pref . "_virt"] = $this->cpuStats[$pref . "_virt"];
            $values[$pref . "_real"] = $this->cpuStats[$pref . "_real"];
            if ($this->oldCpuStats[$pref . "_jiffies"] < 1) {
                $values[$pref . "_cpu_user"] = 0;
                $values[$pref . "_cpu_sys"] = 0;
            } elseif ($this->oldCpuStats[$pref . "_jiffies"] > $this->cpuStats[$pref . "_jiffies"]) {
                $values[$pref . "_cpu_user"] = 0;
                $values[$pref . "_cpu_sys"] = 0;
            } else {
                $delta = $this->cpuStats[$pref . "_jiffies"] - $this->oldCpuStats[$pref . "_jiffies"];
                $values[$pref . "_cpu_user"] = (($this->cpuStats[$pref . "_cpu_user"] - $this->oldCpuStats[$pref . "_cpu_user"]) / $delta) * 100;
                $values[$pref . "_cpu_sys"] = (($this->cpuStats[$pref . "_cpu_sys"] - $this->oldCpuStats[$pref . "_cpu_sys"]) / $delta) * 100;
            }
        }
        # print_r($values);
        return $values;
    }

    public function initCache()
    {
        $this->getStats();
        $this->oldCpuStats = $this->cpuStats;
    }
    
    public function loadCache($cachedata)
    {
        $this->oldCpuStats = $cachedata['opensimGridStats'];
    }
    
    public function getCache()
    {
        return array(
                     'opensimGridStats' => $this->cpuStats,
                     );
    }
    
}

?>
