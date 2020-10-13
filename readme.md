
# Addons Extension Pack for laravel 

## 特性

#### 支持版本

本扩展包支持Laravel5,6,7版本

## 如何安装


### 它安装在存在的项目中。

#### 使用 Composer 添加包

使用 Composer 

```sh
composer require kaneki/laravel-addons
```
## 使用

#### 命令行 

* make:addon  
  ```
  php artisan make:addon [name] [skeleton]
  ```  
  skeleton: [minimum,simple,asset,library,api,ui,ui-sample,admin,generator]  

  参数：    
  --space  
  --namespace  
  --no-namespace  
  --language  
  --yes  

* addon:list  
* addon:name  
* addon:remove [name] --force  
* addon:status [name]  


## License

MIT
