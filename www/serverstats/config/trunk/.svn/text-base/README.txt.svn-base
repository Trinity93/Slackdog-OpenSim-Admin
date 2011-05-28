== Installation Instructions - For Region ==

* Install serverstats (http://serverstats.berlios.de).  If you are
  running Ubuntu 8.10 this is an included package.  If not, you'll
  need to install it by hand.

* Put opensim.php in the config location that includes sources.php for
  server stats.

* Modify sources.php to have the additional following lines:

  include "opensim.php";
  $config['opensim']['module'] = new opensim();

* Add the following lines to graph.php

$config['list'][] = array(
        'title' => 'OpenSim CPU',
        'lowerLimit' => 0,
        'altAutoscaleMax' => true,
        'content' => array(
                array(
                        'type' => 'AREA',
                        'source' => 'opensim',
                        'ds' => 'opensim_cpu_sys',
                        'cf' => 'AVERAGE',
                        'legend' => 'OpenSim Sys CPU%',
                        'color' => 'FF0000',
                ),
                array(
                        'type' => 'AREA',
                        'source' => 'opensim',
                        'ds' => 'opensim_cpu_user',
                        'cf' => 'AVERAGE',
                        'legend' => 'OpenSim User CPU%',
                        'color' => '00FF00',
                        'stacked' => true,
                ),
        )
);

$config['list'][] = array(
	'title' => 'OpenSim Threads',
	'lowerLimit' => 0,
	'altAutoscaleMax' => true,
	'content' => array(
		array(
		        'type' => 'AREA',
                        'source' => 'opensim',
                        'ds' => 'opensim_threads',
                        'cf' => 'AVERAGE',
                        'legend' => 'number of opensim threads',
                        'color' => '0000BB',
		),
        )
);

$config['list'][] = array(
	'title' => 'OpenSim Memory',
        'lowerLimit' => 0,
        'altAutoscaleMax' => true,
	'content' => array(
		array(
			'type' => 'AREA',
                        'source' => 'opensim',
                        'ds' => 'opensim_virt',
                        'cf' => 'AVERAGE',
                        'legend' => 'OpenSim Memory (Virt)',
                        'color' => '00BB00'
                ),
		array(
                        'type' => 'AREA',
                        'source' => 'opensim',
                        'ds' => 'opensim_real',
                        'cf' => 'AVERAGE',
                        'legend' => 'OpenSim Memory (Real)',
                        'color' => 'BB0000'
                ),
        )
);

== Installations Instructions for Grid Server ==

There is also an "opensimgrid.php" for monitoring the 5 grid
services.  This assumes they are all on 1 machine.

To enable these add the following to your sources config:

$config['opensimgrid']['module'] = new opensimgrid();

And the following are reasonable graphs to add:

$config['list'][] = array(
                          'title' => 'Grid CPU',
                          'lowerLimit' => 0,
                          'altAutoscaleMax' => true,
                          'content' => array(
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'grid_cpu_sys',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Grid (sys)',
                                                   'color' => 'D00000',
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'grid_cpu_user',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Grid (user)',
                                                   'color' => 'FF0000',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'user_cpu_sys',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'User (sys)',
                                                   'color' => '108801',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'user_cpu_user',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'User (user)',
                                                   'color' => '19DC00',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'inv_cpu_sys',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Inventory (sys)',
                                                   'color' => '9B0479',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'inv_cpu_user',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Inventory (user)',
                                                   'color' => 'D100A2',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'asset_cpu_sys',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Asset (sys)',
                                                   'color' => 'E36D14',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'asset_cpu_user',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Asset (user)',
                                                   'color' => 'FF6D00',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'msg_cpu_sys',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Msg (sys)',
                                                   'color' => '0C19A8',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'msg_cpu_user',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Msg (user)',
                                                   'color' => '0013E3',
                                                   'stacked' => true,
                                                   ),
                                             )
                          );


$config['list'][] = array(
                          'title' => 'Grid Server Threads',
                          'lowerLimit' => 0,
                          'altAutoscaleMax' => true,
                          'content' => array(
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'grid_threads',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Grid',
                                                   'color' => 'FF0000',
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'user_threads',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'User',
                                                   'color' => '19DC00',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'inv_threads',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Inventory',
                                                   'color' => 'D100A2',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'asset_threads',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Asset',
                                                   'color' => 'FF6D00',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'msg_threads',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Msg',
                                                   'color' => '0013E3',
                                                   'stacked' => true,
                                                   ),
                                             )
                          );

$config['list'][] = array(
                          'title' => 'Grid Server Virt Memory',
                          'lowerLimit' => 0,
                          'altAutoscaleMax' => true,
                          'content' => array(
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'grid_virt',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Grid',
                                                   'color' => 'FF0000',
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'user_virt',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'User',
                                                   'color' => '19DC00',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'inv_virt',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Inventory',
                                                   'color' => 'D100A2',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'asset_virt',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Asset',
                                                   'color' => 'FF6D00',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'msg_virt',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Msg',
                                                   'color' => '0013E3',
                                                   'stacked' => true,
                                                   ),
                                             )
                          );

$config['list'][] = array(
                          'title' => 'Grid Server Real Memory',
                          'lowerLimit' => 0,
                          'altAutoscaleMax' => true,
                          'content' => array(
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'grid_real',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Grid',
                                                   'color' => 'FF0000',
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'user_real',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'User',
                                                   'color' => '19DC00',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'inv_real',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Inventory',
                                                   'color' => 'D100A2',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'asset_real',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Asset',
                                                   'color' => 'FF6D00',
                                                   'stacked' => true,
                                                   ),
                                             array(
                                                   'type' => 'AREA',
                                                   'source' => 'opensimgrid',
                                                   'ds' => 'msg_real',
                                                   'cf' => 'AVERAGE',
                                                   'legend' => 'Msg',
                                                   'color' => '0013E3',
                                                   'stacked' => true,
                                                   ),
                                             )
                          );

== Tuning Server Stats for better behavior ==
The default serverstats is designed to graph every 5 minutes.  Because
it works off cron the smallest timeslice you can get is every 1
minute.  To get to that resolution you need to do the following:

* change the cronjob to run every minute

* change the "step" in main.php to be 60 instead of 300

* delete the rrd files in /var/lib/serverstats/rrd/.  The time step is
  set in the rrd files when they are created, so if you make a change
  here you need to wipe your historic data to get the new ones
  graphing

* create a 3 hour graph by adding

    array('title' => '3 Hour', 'period' => 10800),

  to the $config['types'] array, and set this as the default by
  setting:
    
    $config['defaultperiod'] = 10800;

You may also want to modify 'index.php' to refresh every 60 seconds.
This can be done by adding:

   <meta http-equiv="refresh" content="60"/>

Somewhere in the <head> section of index.php.  Refreshing any faster
than 60 seconds is a waste of time because your graphs only have a 60
second resolution.

== Known Issues / Limitations ==

* This only works on Linux, sorry.  I'm doing data collection via the
  proc file system.
* This only works if you have 1 opensim instance on the box.  If you
  have more than one this will monitor the first one (by lowest
  process id).  That's ripe for future enhancement.
* Real memory is "close", I'm not convinced it is byte level
  accurate.  I need to hit up a kernel guy to explain the descrepancy
  I am seeing.
* CPU is in jiffies, which is useful for relative comparison, but
  doesn't really give you absolute CPU numbers.  This should be fixed,
  but I need to look into that.
* You need a reasonably modern linux to get the jiffies out of
  /proc/timer_list like I'm doing.  Old linux versions won't display
  CPU correctly.
