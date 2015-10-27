# REST API - Filter Fields #
**Contributors:** svrooij  
**Donate link:** http://svrooij.nl/buy-me-a-beer  
**Tags:** json, rest, api, rest-api  
**Requires at least:** 4.3-alpha  
**Tested up to:** 4.3.1  
**Stable tag:** trunk  
**License:** MIT  
**License URI:** https://raw.githubusercontent.com/svrooij/rest-api-filter-fields/master/LICENSE  

Filter the properties returned by the wordpress rest api V2

## Description ##

The [wp-rest-api-v2](https://wordpress.org/plugins/rest-api/) returns a lot of properties.
It could be very useful (or mobile-data-friendly) to only return the properties needed by the application.

If you only want titles and links of some articles it doesn't make sense to return the content or the excerpt.

This isn't limited to posts, it also works on custom posttypes, pages, terms, taxonomies and comments.

Instead of returning:

    {
      "id": 2138,
      "date": "2015-10-25T15:31:03",
      "guid": {
        "rendered": "http://worldofict.nl/?p=2138"
      },
      "modified": "2015-10-25T15:31:03",
      "modified_gmt": "2015-10-25T14:31:03",
      "slug": "rechtenvrije-fotos",
      "type": "post",
      "link": "http://worldofict.nl/tip/2138-rechtenvrije-fotos/",
      "title": {
        "rendered": "Rechtenvrije foto&#8217;s"
      },
      "content": {
        "rendered": ".. A lot of content .. "
      },
      "excerpt": {
        "rendered": " .. A lot of content ..."
      },
      "author": 2,
      "featured_image": 2139,
      "comment_status": "open",
      "ping_status": "open",
      "sticky": false,
      "format": "standard",
      //.. even more tags ....
    }

It can return (with ``fields=id,title,link`` as GET parameter)

    {
      "id": 2138,
      "link": "http://worldofict.nl/tip/2138-rechtenvrije-fotos/",
      "title": {
        "rendered": "Rechtenvrije foto&#8217;s"
      }
    }

### Notes ###

1. If you specify fields so it wouldn't return data the default response is send back to the client.
2. (for developers) something wrong with this plugin? [Github](https://github.com/svrooij/rest-api-filter-fields/)


## Installation ##

Installing this plugin is really easy.

1. Upload `rest-api-filter-fields.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

You can also download it through the build-in plugin manager.
Then it will be installed in `/wp-content/plugins/rest-api-filter-fields/`.

## Frequently Asked Questions ##

### Does this also work for my custom posttype? ###

Yes, we picked 100 as priority (default = 10) for activating.
This mean this plugin is probably activated last, so all custom post types should already be loaded.

### I found a bug, what should I do? ###

All the bugs/issues are maintained on [github.com/svrooij/rest-api-filter-fields](https://github.com/svrooij/rest-api-filter-fields/issues)
so please create an issue (or a pull request with a fix there)
