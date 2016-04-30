Introduction
============
This plugin adds a circuit field as a submission plugin for the assignment module. The circuit is based on the activity module moodle-mod_circuits available on github (https://github.com/GuillaumeBlin/moodle-mod_circuits). 

This project provides the excellent SimcirJS project (https://kazuhikoarase.github.io/
simcirjs/) as both a moodle activity and a moodle assignment submission plugins. It al
lows students to design, try and test combinatorial and sequential circuits. Teacher c
an assign some circuits exercice to students.
  
Installation
============

Install the dependencies
-----------------------

To install the plugin using git, execute the following commands in the root of your Mo
odle install:

    git clone https://github.com/GuillaumeBlin/moodle-mod_circuits.git your_moodle_root/mod/circuits
    
Or, extract the following zip in `your_moodle_root/mod/` as follows:

    cd your_moodle_root/mod/
    wget https://github.com/GuillaumeBlin/moodle-mod_circuits/archive/master.zip
    unzip -j master.zip -d circuits

Install the assignment module
----------------------

To install the plugin using git, execute the following commands in the root of your Mo
odle install:

    git clone https://github.com/GuillaumeBlin/moodle-mod_assignsubmission_circuits your_moodle_root/mod/assign/submission/circuits
    
Or, extract the following zip in `your_moodle_root/mod/assign/submission` as follows:

    cd your_moodle_root/mod/assign/submission
    wget https://github.com/GuillaumeBlin/moodle-mod_assignsubmission_circuits/archive/master.zip
    unzip -j master.zip -d circuits

Authors and Contributors
=================

In 2016, Guillaume Blin (@GuillaumeBlin) based on Kazuhiko Arase (@kazuhikoarase) Simc
irJS project.
