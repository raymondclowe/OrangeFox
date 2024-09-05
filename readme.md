# OrangeFox Plugin

## Description

The OrangeFox plugin enhances user experience tracking for site optimization by allowing you to display advertisements and track user interactions. It provides a dashboard widget to view metrics, as well as an admin configuration page to customize the advertisement settings.

## Features

- User Experience Tracking: Tracks interactions with displayed advertisements.
- Dashboard Widget: Displays metrics for user interactions in the WordPress dashboard.
- Admin Configuration: Allows configuration of banner and click URLs for advertisements through an admin page.

## Installation

1. Download the OrangeFox plugin files.
2. Upload the orangefox.php file to the /wp-content/plugins/ directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Configure the plugin settings via the 'OrangeFox' settings page in the WordPress admin.

## Usage

Once activated, you can access the OrangeFox configuration page under the Settings menu in the WordPress admin. Here you can set the banner image URL and the click destination URL. The plugin will inject the advertisement into the footer of your site.

## Code Overview

### orangefox.php

- Plugin Header: Defines the plugin name, description, version, and author.
- Initialization: Sets up options for tracking data and configuration on plugin activation.
- Admin Menu: Adds an options page to configure plugin settings.
- Widget Setup: Adds a dashboard widget to display user interaction metrics.
- Tracker Injection: Injects the advertisement HTML into the footer.
- AJAX Handling: Processes user interaction data via AJAX requests.

### adserver-orangefox.js

- Interaction Tracking: Sends a POST request to update metrics based on whether the advertisement is displayed or hidden.

## Configuration

### Admin Settings

- Banner Image URL: The URL for the advertisement image.
- Click Destination URL: The URL to redirect users when they click on the advertisement.

### Metrics Display

The dashboard widget displays:

- Total Interactions: Sum of all interactions.
- A Interactions: Count and percentage of interactions for option A.
- B Interactions: Count and percentage of interactions for option B.

## Contributing

Feel free to contribute to the OrangeFox plugin by submitting issues or pull requests on the GitHub repository.

## License

This plugin is open-source and available under the GNU General Public License.

