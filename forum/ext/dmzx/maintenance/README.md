# Maintenance mode Extension

## Install
1. Download the latest release.
2. Unzip the downloaded release, and change the name of the folder to `maintenance`.
3. In the `ext` directory of your phpBB board, create a new directory named `dmzx` (if it does not already exist).
4. Copy the `maintenance` folder to `ext/dmzx/` (if done correctly, you'll have the main extension class at (your forum root)/ext/dmzx/maintenance/composer.json).
5. Navigate in the ACP to `Customise -> Manage extensions`.
6. Look for `Maintenance mode` under the Disabled Extensions list, and click its `Enable` link.

## Uninstall
1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `Maintenance mode` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/dmzx/maintenance` folder.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)
