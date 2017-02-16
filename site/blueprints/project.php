<?php if(!defined('KIRBY')) exit ?>

title: Project
files: true
pages: false
files:
  fields:
    caption:
      label: Caption
      type: textarea
fields:
  prevnext: prevnext
  title:
    label: Title
    type:  text
    width: 3/4
  date:
    label: Year
    type:  date
    format: YYYY
    width: 1/4
  subtitle:
    label: Subtitle
    type: text
    width: 3/4
  featured:
    label: Featured image
    type: image
    width: 1/4
  text:
    label: Description
    type: textarea
    help: for SEO only
  medias: 
    label: Images
    type: gallery