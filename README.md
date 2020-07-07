# It is the Front End of SOA CRUD APP (SOA Dashboard)

### To use the Whole App kindly clone soafrontend and soa backend  
### Then Make Virtual Hosts accroding to images attached in folder.

#### steps to make virtual host
#### step 1:
##### Go to location =>  xampp\apache\conf\extra\ now open httpd-vhosts file and copy paste and save following:


## <VirtualHost 127.0.0.2:80>
  ## DocumentRoot "D:/xampp/htdocs/crudbackend/public"
  ## ServerName soacrud-api-local
  ## ServerAlias soacrud-api-local
## </VirtualHost>

## <VirtualHost 127.0.0.1:80>
  ## DocumentRoot "D:/xampp/htdocs/crudfronte/public"
   ## ServerName soacrud-dashboard-local
   ## ServerAlias soacrud-dashboard-local
## </VirtualHost>

#### step 2:
##### Now go to => C:\Windows\System32\drivers\etc\ and open host first cut host and paste on desktop and open paste below line save it and then paste it back to C:\Windows\System32\drivers\etc\

## 127.0.0.2       soacrud-api-local
## 127.0.0.1       soacrud-dashboard-local

### make Database named as => "soacrud"
### navigate to soa backend and run migration => php artisan migrate 
### sign up , sign in , logout , user crdu management and listing using DataTables and AJAX 
