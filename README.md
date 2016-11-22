## monitor-string for WordPress
This is a very simple WordPress plugin that scratches a very specific itch. There are many services out there that will monitor the uptime of your website, and check for a specific string to ensure the website is being displayed properly. But when you have a dynamic site, like a WordPress site, content of the page can change at any time. So, the eternal question is: What string do I check for on my site? This plugin aims to answer that question.

Many times people will check for a string in the page footer, often the copyright text, but if you include the year in your check on Janurary 1 you wake up to a false positive for all of the sites you monitor.

Enter monitor-string. This plugin allows you create a specific string (or generate a random string) that will be inserted into the footer of each page. The action is added to wp_footer with a priority of 1000, which should make your monitor-string show up as the very last thing in the site markup. So if that string appears, you can be confident that the rest of your site rendered correctly.

## Installation
Clone this repo and copy the directory into your wp-content/plugins directory and activate!
