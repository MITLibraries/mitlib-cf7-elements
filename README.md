# MITlib CF7 Elements

[![Code Climate](https://codeclimate.com/github/MITLibraries/mitlib-cf7-elements/badges/gpa.svg)](https://codeclimate.com/github/MITLibraries/mitlib-cf7-elements)
[![Issue Count](https://codeclimate.com/github/MITLibraries/mitlib-cf7-elements/badges/issue_count.svg)](https://codeclimate.com/github/MITLibraries/mitlib-cf7-elements)

This plugin provides three new field types to the Contact Forms 7 plugin:

1. An authenticate button that passes the user through Touchstone.
2. A dropdown control that is populated with the list of departments, labs, and centers at MIT.
3. An option to send the user to a thank you page after form submission.

Additionally, the plugin adds a validation step for select and radio fields to prevent form hijacking.

## Prerequisites

This plugin assumes that you have a WordPress site with [Contact Forms 7](https://wordpress.org/plugins/contact-form-7/) installed.

## Use

To add any provided fields to your form, add `[authenticate]`, `[select_dlc]`, or `[thank_you]` to your form design as desired. If your form needs the DLC selection to be a required field, the plugin supports the `select_dlc*` designation.

The added validation step applies to all select and radio fields. No actions need be taken by form builders.
