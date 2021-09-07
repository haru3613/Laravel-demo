
## About this project

此專案為IT邦幫忙鐵人賽laravel用的紀錄

## Environment
* Mac OS Big Sur 11.4
* Docker version 20.10.8
## Usage
1. 從零開始建立一個名為sandbox的Laravel專案
```
$ curl -s "https://laravel.build/sandbox" | bash

$ cd sandbox

$ ./vendor/bin/sail up
```
2. 在~/.zshrc檔案最後方設定別名，方便之後使用sail
```
$ vim ~/.zshrc

alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```
3. 

