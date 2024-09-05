# OrangeFox WordPress Plugin

## Description

OrangeFox is a WordPress plugin designed to detect and track the usage of ad-blocking software among your website visitors. It uses a non-intrusive method to gather statistics on how many of your users are employing ad blockers.

## Features

- Detects ad-blocking software usage
- Tracks the number of visitors using and not using ad blockers
- Provides a dashboard widget with usage statistics
- Includes a configurable settings page for customization

## How It Works

1. The plugin adds a hidden element to your pages that mimics an advertisement.
2. It then checks if this element is hidden or removed by ad-blocking software.
3. The results are sent back to your WordPress site and stored anonymously.
4. Statistics are displayed in a dashboard widget for easy viewing.

## Installation

1. Upload the `orangefox` folder to your `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Configure the plugin settings under the 'OrangeFox' option in your WordPress settings menu.

## Configuration

In the settings page, you can customize:
- The text used in the hidden "advertisement" element
- The URL linked in the hidden element

## Privacy Considerations

This plugin does not collect any personal data. It only tracks anonymous statistics about ad-blocker usage on your site. However, you should mention the use of this tracking in your site's privacy policy to maintain transparency with your users.

## Legal Notice

While this plugin is designed to be discreet to avoid being blocked by ad-blocking software, it is intended to be used ethically and legally. Always ensure that your use of this plugin complies with all relevant laws and regulations in your jurisdiction, particularly those concerning user privacy and data collection.

## Support

For support, feature requests, or bug reports, please open an issue on the plugin's GitHub repository.

## License

This plugin is released under the GPL v2 or later license.