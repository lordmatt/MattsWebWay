# About Matt's Web Way

Matt's Web Way (MWW) is a semi-static site framework designed to be as light as humanly possible.

MWW turns MarkDown files into light webpages.


## File selection

MWW supports two types of (mostly) static content MarkDown Files (*.md) and PHP.
This is because it seemed like a good idea at the time. PHP is a lot of fuss and only
good if you need limited dynamic stuff. Otherwise just write in MD, it's nicer to maintain.

MWW supports unlimited folder depth, MarkDown, YAML for meta content.

Each webpage is (by default) displayed with the bare minimum CSS needed to make 
the page nice to read. You can make your own theme if you want something more
complicated. HTML markup is truely miinimal. Speed and light pages is the whole
point here.


## Directory/Folder names

You can use any directory/folder naming you want. I strony suggest replacing 
spaces with - or _ but only because the URL looks nicer. 

There are three folders it is unwise to use:

- core
- plugins
- template

There's nothing stopping you using them. MWW will work just fine but I recommend
using something else as MWW's code lives there. By default these folders are not
indexable and just show a page saying "No".

There are two things you don't want in a folder name ".php" and ".md" as these 
will get stripped out.



## Libraries

YAML is powered by the [Spyc YAML lib](https://github.com/mustangostang/spyc/) under the MIT license 

MarkDown is powered by [Parsedown the MD lib](http://parsedown.org) under the MIT license 

## Plugins

MWW supports extensions via a simple plugin system. This is because the core is
meant to do the least possible work.

### RelMe

RelMe is a plugin I wrote to test the extension system. It adds rel='me' to links
and is triggered by a flag relMeList in the YAML.

    ---
    flags: relMeList
    ---

To enable it, edit /plugins/init.php and remove the #s to uncomment the two lines.

## Getting started

1. Stick your files in whatever space serves your web content using PHP.
2. Edit init.php and give it sensible values.
3. Add your files and view them.

## Setting an index page

MWW is designed to use directories (folders) as files. There is an order MWW looks
for root files in:

1. home.md
2. index.php
3. index.md

When it finds one it stops looking. home.md is the recommended file name. The
others are just for compatibility with stuff I was trying out.


## FAQ

#### How do I view the raw file?

If you request the MD file directly, it will show it to you. Without the *.md it 
will convert the file to HTML.

#### Does this support Obsidian.md?

More or less, yes. While some of the more advanced tag stuff is not implemented,
MWW will faithfully show most of your Obsidian files as you might expect.

#### Will you add a file editor?

Probably not. It would be a bit of a security nightmare. Also FTP is just fine.
The whole point is that the site is (almost) static.

#### Can I request a plugin or feature?

You may request. I probably won't be the one to write it. However, if you ask,
someone might be nice enough to make one. Or you can make it yourself - learning
to code is good for future employability and is a great hobby IMHO.

#### What does the YAML do?

Not a lot. I use it to set an author, some flags (one), the page title, page 
description, and some document meta. Mostly just doc meta. I tend to track 
changes with a manual version history. Like this:

    ---
    title: Matt's Links
    description: Many of the ways to find Matt on the web
    meta: 
        Created: 20 June 2025
        Version: 2.00.000
        Status: Never going to be finished
        keywords: keyword1, keyword2
        history:
            14 November 2025: Converted to MD and added new links
            20 June 2025: Created with code
        flags: 
            flag: relMeList
    author: @LordMatt
    ---

#### How do I make a new theme?

Copy the template folder. 

Give your new folder a different name. 

Edit first.php to suit your design. If you want, edit the other files, I guess. 

Edit init.php, uncomment the custom template line and give it your folder name.

You now have your own theme. Enjoy.

#### Patu support?

Yeah, go ahead and add a [patu.txt](https://github.com/akrito/patu/tree/master) file to your root MWW folder. It will just work.

#### Robots?

There's a default robots.txt file in these files. It tells well behaved AI to 
jog on. Edit as you see fit.