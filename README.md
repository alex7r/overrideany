# overrideany
Overrides any method you want in Joomla! CMS
## example
For now plugin is hardcoded to override `ContentModelCategory` with file at `/core/content/models/category.php`

You can change or add `inital`(file to override) file and `target` (file with override) file by changing next lines in the constructor:
```PHP
/* EXAMPLE */
$overridables['CLASSTOOVERRIDE']['initial'] = JPATH_BASE . '/components/com_content/models/category.php';
$overridables['CLASSTOOVERRIDE']['target']  = JPATH_BASE . '/core/content/models/category.php';
```

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
