@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../satooshi/php-coveralls/bin/coveralls
php "%BIN_TARGET%" %*
