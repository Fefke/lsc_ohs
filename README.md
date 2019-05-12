# lsc_ohs
Order History Summary for litecart

## Instructions ##

(!) 1. Always backup data before making changes to your store.  
    2. Copy the inside of the *public_html/*
    3. Go to your *litecart's* document root (in your directory)    
    4. Paste it into there
    5. test it with an account you ordered something before.
 
## Modification Instructions ##
( ! ) Please make sure you didn't have any custom code in your *order_history.inc.php* file.
      Otherwise it would be overridden. If you dont know how to solve this contact me: support@beetdev.de

You can change the part, the user sees. For this check the *order_history.inc.php* in the *pages* directory of your template.
( i ) Please don't delete anything out of the vQmod.

### Troubleshooting  
  
It is not working?  

     1. Check your current template... is it the *default.catalog*?   
     
          No?  
            1.1 Copy the file (*order_history.inc.php*) in: (__ohs__) 
                ***public_html*** > ***includes*** > ***templates*** >  ***default.catalog*** > ***pages*** 
            1.2 Open the ***pages*** direcotry in your template and paste the *order_history.inc.php* in there.
                ( ! ) Older changes to this file might be lost.
    
     2. Is the vQmod allowed? Check it in your *admin panel* > *vqmod* (lowermost)
          No?
            2.1 Check the *order_history_summary* vQmod
            2.2 Click on the **Enable** button

     3. Have you already ordered something? (Its backward compatible => in time)
          No?
            Please order something or create an dummy account and place an order for him over the admin panel
     
     4. Contact me: 
     https://beetdev.de/#kontakt || support@beetdev.de
