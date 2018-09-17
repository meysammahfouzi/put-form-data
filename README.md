# Introduction
There is a bug in php which has been described [here:](https://bugs.php.net/bug.php?id=55815)

Data that is posted to PHP via the PUT method is not parsed at all and is not 
available to PHP.
This is particularly problematic for data sent encoded as 'multipart/form-data'.

Basically, a request sent (with files and/or non-file data) via PUT should be 
parsed using the same functions used for requests sent via POST.

This is an [OctoberCMS](https://github.com/octobercms/october) plugin which fixes this problem. 

# The Problem
Suppose you are calling a REST API which accepts two parameters: `title` and `photo`.  
This API must be called via `PUT` method to update a resource.  
In your javascript code, you encode the title and photo as `multipart/form-data` and send the `PUT` request.  
On the server side though, because of the above PHP bug, trying to access the uploaded file or accessing the title field
will fail. In other words, all of the following will either return false or null:  

- Input::has('title')
- Input::get('title')
- Input::hasFile('photo') 
- Input::file('photo')

# Solution
By simply installing this plugin, the `form-data` become available in your `PUT` and `PATCH` requests exactly as they 
appear in `POST` requests.
