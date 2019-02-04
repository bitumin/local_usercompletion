## Moodle plugin local_usercompletion

Shows simple user completion reports.

### Plugin installation

Go to your moodle instance root directory and then:

```
cd local
git clone https://github.com/bitumin/local_usercompletion.git usercompletion
```

Then login as an admin and run the plugins upgrade as usual.

### Behat tests

After setting up your behat testing environment:

```
php admin/tool/behat/cli/run.php --tags="@local_usercompletion"
```

### Plugin development summary

There are two entry points:  
* `index.php` shows the user list
* `report.php` shows the course completion report for a given user  

The renderer methods are in `output/renderer.php`  
 
There are two renderables:
* `output/userlist_view.php` is based in rendering a `table_sql`
 (the table html code is brought to a mustache template at
 `templates\userlist_view.mustache`).
* Alternatively, `output/completionreport_view.php` is based in exporting
 data using the exporter at `external/completionreport_view_exporter.php`
 and generating the html using the features of the mustache template at 
 `templates\completionreport_view.mustache`. 

A behat feature can be found at `tests/behat/view_users_list.feature`
and one fixture has been created at `tests/behat/behat_local_usercompletion.php`
