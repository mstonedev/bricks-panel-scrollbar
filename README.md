# bricks-panel-scrollbar

Easily restore and customize the left side panel scrollbar inside the Bricks Builder editor interface. 

## Description

By default, the Bricks Builder editor interface hardcodes styles (`scrollbar-width: none` and `display: none`) that completely hide the vertical scrollbar on the left builder settings panel (`#bricks-panel-inner`). This plugin forcefully overrides those theme restrictions to bring the scrollbar back.

It adds a dedicated configuration panel directly to your WordPress **Settings > General** dashboard page, allowing you to visually style the scrollbar width, track color, and thumb color without writing any code.

### Features
* **Restores Lost UI Navigation:** Brings back the scrollbar intentionally hidden by Bricks theme core files.
* **Dashboard Settings Integration:** Seamless color pickers and width fields directly integrated under WordPress Settings.
* **Isolated Builder Scope:** Code only triggers and prints inside the active builder window, keeping your site's frontend code fast and clean.
* **Theme-Update Safe:** Operates independently of your active theme or child theme files.

## Installation

### From your WordPress Dashboard
1. Download or save the plugin code into a folder named `bricks-custom-scrollbar`.
2. Compress the folder into a `.zip` archive named `bricks-custom-scrollbar.zip`.
3. Go to **Plugins > Add New Plugin** in your WordPress dashboard.
4. Click **Upload Plugin**, choose your zip file, and click **Install Now**.
5. Click **Activate Plugin**.

### Via FTP / SFTP
1. Upload the unzipped `bricks-custom-scrollbar` directory to your `/wp-content/plugins/` directory.
2. Navigate to the **Plugins** menu in your WordPress dashboard.
3. Locate **Bricks Builder Custom Scrollbar** in the list and click **Activate**.

## Usage

Once activated, configuration is handled entirely through the native WordPress admin dashboard:

1. In your WordPress dashboard sidebar, go to **Settings > General**.
2. Scroll to the very bottom of the page to find the **Bricks Panel Scrollbar Settings** section.
3. Configure your preferences:
   * **Scrollbar Thumb Color:** Choose a custom background color for the draggable handle element.
   * **Scrollbar Track Color:** Choose a custom background color for the static foundation rail track beneath the handle.
   * **Scrollbar Width (px):** Set a numeric layout thickness constraint (recommended thin sizes: `4px` to `8px`).
4. Click **Save Changes**.
5. Launch your Bricks Builder interface canvas to see your new custom-styled thin layout track instantly in effect.

## Frequently Asked Questions

### Why didn't adding standard CSS to Page Settings work?
The left settings panel lives on the parent administrative frame of the WordPress layout tree, while the "Page Settings > Custom CSS" area in Bricks is completely isolated within a nested frontend content canvas iframe sandbox. This plugin works because it hooks directly into the global frame layer using high-priority server-side scripts.

### Does this impact the loading speed of my frontend pages?
No. The plugin includes a built-in validation check (`bricks_is_builder()`) that actively halts execution on your regular frontend public-facing web pages. The custom stylesheet layout rules are only printed when an administrative builder canvas is active.

## Changelog

### 1.1.0 (2026-09-19)
* Added administrative settings field configurations directly into Settings > General page layout panels.
* Converted static style configurations into dynamic variable injections.

### 1.0.0
* Initial codebase creation implementing the `wp_print_scripts` targeted priority hook.
