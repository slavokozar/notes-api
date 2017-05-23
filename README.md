# notes-api

This API is an example API for single-page application. 
It was created for purposes of JavaScript lectures at codingbootcamp.cz

API is designed for CRUD operations over Note object.

Note object has these properties:
- id
- title
- text 
- created_at
- updated_at

API returns json representation of objects / arrays.

## API demo

This api demo is running at: 

*http://notes.webpixels.sk/*

## API requests

### index
    
*return array of all notes*

**method:** GET

**url:**
/notes/index.php

**data:**
- limit 
- offset
- order_by 
- order_type (asc | desc)

### store
    
*create note with title and text*

**url:**
/notes/store.php

**method:** POST

**data:**
- title 
- text



### show
    
*return one note with provided id*

**method:** GET

**url:** /notes/show.php?id=

### update
    
*update one note with provided id*

**method:** POST

**url:** /notes/update.php?id=

**data:**
- title 
- text

### delete
    
*delete one note with provided id*

**method:** GET

**url:** /notes/delete.php?id=






