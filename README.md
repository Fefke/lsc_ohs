# lsc_ohs
Order History Summary for litecart
Fully done with vQmod (virtual quick mod)
> for easy integration > and minimal trouble with errors

## Instructions ##

(!) 1. Always backup data before making changes to your store.  
  
Easiest way:  
     2. Go to your **administration panel** > **vqmods**.  
     3. Select the **order_history_summary.xml** file and upload it.  

Other way (over filesystem):  
      2. Go to your *litecart's* document root (in your directory)    
      3. Move to **vqmod** > **xml**  
      4. Paste the **order_history_summary.xml** in here.  
 
 
## Modification Instructions ##
### Troubleshooting  
  
It is not working?  

     1. Check your current template... is it the *default.catalog*?   
     
          No?  
> go to  **document root (/)** > **vqmod** > **xml** 
> open the **order_history_summary.xml** file
> Go to **line 57**
> change *default.catalog* to yor templates name, like: **mytemplate**

     2. Have you already ordered something? (Its backward compatible => in time)
     
     3. Contact me: 
     https://beetdev.de/#kontakt || support@beetdev.de
