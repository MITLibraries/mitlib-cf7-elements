# MITlib CF7 Elements

[![Build Status](https://travis-ci.org/MITLibraries/mitlib-cf7-elements.svg)](https://travis-ci.org/MITLibraries/mitlib-cf7-elements)
[![Code Climate](https://codeclimate.com/github/MITLibraries/mitlib-cf7-elements/badges/gpa.svg)](https://codeclimate.com/github/MITLibraries/mitlib-cf7-elements)
[![Issue Count](https://codeclimate.com/github/MITLibraries/mitlib-cf7-elements/badges/issue_count.svg)](https://codeclimate.com/github/MITLibraries/mitlib-cf7-elements)

This plugin provides two new field types to the Contact Forms 7 plugin:

1. An authenticate button that passes the user through Touchstone.
2. A dropdown control that is populated with the list of departments, labs, and centers at MIT

## Prerequisites

This plugin assumes that you have a WordPress site with [Contact Forms 7](https://wordpress.org/plugins/contact-form-7/) installed.

## Use

To add these fields to your form, add `[authenticate]` or `[select_dlc]` to your form design as desired. If your form needs the DLC selection to be a required field, the plugin supports the `select_dlc*` designation.
