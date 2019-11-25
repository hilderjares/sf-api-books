# Somee.Social Rest API

## **Book**

### API Resources

  - [GET /book](#get-books)
  - [GET /book/[id]](#get-bookid)
  - [POST /book](#post-book)
  - [PUT /book/[id]](#put-book)
  - [DELETE /book/[id]](#delete-book)

### GET /book

Response body:

    {
        "message": "all books",
        "data": [
            {
                "id": 2,
                "title": "gambi pattern 2",
                "launch_date": "2021-05-10T00:00:00+00:00",
                "updated_at": "2019-11-25T01:15:51+00:00",
                "created_at": "2019-11-25T01:07:14+00:00"
            },
            {
                "id": 3,
                "title": "gambi pattern",
                "launch_date": "2020-05-10T00:00:00+00:00",
                "updated_at": null,
                "created_at": "2019-11-25T01:07:17+00:00"
            }
        ]
    }

### GET /book/[id]

Response body:

    {
        "book": {
            "id": 3,
            "title": "gambi pattern",
            "launch_date": "2020-05-10T00:00:00+00:00",
            "updated_at": null,
            "created_at": "2019-11-25T01:07:17+00:00"
        }
    }

### POST /book

Request body:

    {
        "title": "gambi pattern 2",
        "author": 4,
        "launch_date": "10-05-2021"
    }

Response body:

    {
        "message": "book inseted"
    }

### PUT /book/[id]

Request body:

    {
        "title": "gambi pattern 3",
        "author": 4,
        "launch_date": "10-05-2021"
    }

Response body:

    {
        "message": "book updated"
    }


### DELETE /book/[id]

Response body:

    {
        "message": "deleted book with id 1"
    }


***

## **Author**

### API Resources

  - [GET /author](#get-authors)
  - [GET /author/[id]](#get-authorid)
  - [POST /author](#post-author)
  - [PUT /author/[id]](#put-author)
  - [DELETE /author/[id]](#delete-author)

### GET /author

Response body:

    {
        "authors": [
            {
            "id": 1,
            "name": "sid",
            "date_of_birth": "1998-10-29T00:00:00+00:00",
            "updated_at": null,
            "created_at": "2019-11-24T21:25:24+00:00",
            "books": []
            },
        ]
    }

### GET /author/[id]

Response body:

    {
        "author": {
            "id": 2,
            "name": "sid",
            "date_of_birth": "1998-10-29T00:00:00+00:00",
            "updated_at": null,
            "created_at": "2019-11-24T21:29:23+00:00",
            "books": [
                {
                    "id": 2,
                    "title": "gambi pattern 2",
                    "launch_date": "2021-05-10T00:00:00+00:00",
                    "author": [],
                    "updated_at": "2019-11-25T01:15:51+00:00",
                    "created_at": "2019-11-25T01:07:14+00:00"
                },
                {
                    "id": 3,
                    "title": "gambi pattern",
                    "launch_date": "2020-05-10T00:00:00+00:00",
                    "author": [],
                    "updated_at": null,
                    "created_at": "2019-11-25T01:07:17+00:00"
                }
            ]
        }
    }

### POST /author

Request body:

    {
        "name": "sid",
        "date_of_birth": "29-10-1998"
    }
    
Response body:

    {
        "message": "author inserted"
    }

### PUT /author/[id]

Request body:

    {
        "name": "sid",
        "date_of_birth": "29-10-1998"
    }

Response body:

    {
        "message": "author updated"
    }


### DELETE /author/[id]

Response body:

    {
        "message": "deleted author with id 1"
    }