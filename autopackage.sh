cp -rf /Applications/MAMP/htdocs/Joomla_3.2.0-Stable-Full_Package/administrator/components/com_eventshandler/* /Users/athirat28/mie/com_eventshandler/administrator
mv /Users/athirat28/mie/com_eventshandler/administrator/eventshandler.xml /Users/athirat28/mie/com_eventshandler/eventshandler.xml 
cp -f /Applications/MAMP/htdocs/Joomla_3.2.0-Stable-Full_Package/administrator/language/en-GB/en-GB.com_eventshandler.ini /Users/athirat28/mie/com_eventshandler/administrator/language/
cp -f /Applications/MAMP/htdocs/Joomla_3.2.0-Stable-Full_Package/administrator/language/en-GB/en-GB.com_eventshandler.sys.ini /Users/athirat28/mie/com_eventshandler/administrator/language/
cp -f /Applications/MAMP/htdocs/Joomla_3.2.0-Stable-Full_Package/administrator/language/it-IT/it-IT.com_eventshandler.ini /Users/athirat28/mie/com_eventshandler/administrator/language/
cp -f /Applications/MAMP/htdocs/Joomla_3.2.0-Stable-Full_Package/administrator/language/it-IT/it-IT.com_eventshandler.sys.ini /Users/athirat28/mie/com_eventshandler/administrator/language/
cp -rf /Applications/MAMP/htdocs/Joomla_3.2.0-Stable-Full_Package/components/com_eventshandler/* /Users/athirat28/mie/com_eventshandler/site
cp -f /Applications/MAMP/htdocs/Joomla_3.2.0-Stable-Full_Package/administrator/language/en-GB/en-GB.com_eventshandler.ini /Users/athirat28/mie/com_eventshandler/site/language/
cp -f /Applications/MAMP/htdocs/Joomla_3.2.0-Stable-Full_Package/administrator/language/it-IT/it-IT.com_eventshandler.ini /Users/athirat28/mie/com_eventshandler/site/language/
cp -rf /Applications/MAMP/htdocs/Joomla_3.2.0-Stable-Full_Package/media/com_eventshandler/* /Users/athirat28/mie/com_eventshandler/
cd /Users/athirat28/mie/com_eventshandler/
zip -r ../com_eventshandler.zip *
