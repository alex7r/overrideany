# overrideany
Overrides any method you want in Joomla! CMS
## example
For now plugin is hardcoded to override `ContentModelCategory` with file at `/core/content/models/category.php`

Conten of `/core/content/models/category.php` might be like
```PHP
class ContentModelCategory extends ContentModelCategoryBase
{
	public function getItems(){
	    echo "Overrided!!!";
	    return parent::getItems();
    }
}
```
p.s. with, or without `<?php ` at the start of the file
