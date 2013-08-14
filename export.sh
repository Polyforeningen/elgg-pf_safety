#! /bin/sh

name=pf_safety
version=`cat $name/manifest.xml | grep '<version>' | head -1 | cut -f2 -d'>' | cut -f1 -d'<'`
git archive --prefix=$name-$version/ --format=zip --output=$name-$version.zip HEAD $name
