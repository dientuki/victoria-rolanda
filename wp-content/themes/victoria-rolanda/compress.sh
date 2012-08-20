echo 'starting...'

mkdir -p tmp/css

echo 'compresing css...'

java -jar /usr/share/yui/yuicompressor.jar --type css --line-break 200 -o tmp/css/10_normalize.css  css/normalize.css
java -jar /usr/share/yui/yuicompressor.jar --type css --line-break 200 -o tmp/css/20_fonts.css  css/fonts.css
java -jar /usr/share/yui/yuicompressor.jar --type css --line-break 200 -o tmp/css/30_style.css  css/style.css
java -jar /usr/share/yui/yuicompressor.jar --type css --line-break 200 -o tmp/css/40_carousel.css  css/carousel.css
java -jar /usr/share/yui/yuicompressor.jar --type css --line-break 200 -o tmp/css/50_wp-polls.css  css/wp-polls.css

java -jar /usr/share/yui/yuicompressor.jar --type css --line-break 200 -o tmp/css/ie-min.css  css/ie.css

cat tmp/css/* > css/vr-min.css
echo 'css compresed...'

echo 'compresing js...'
mkdir -p tmp/js

#java -jar /usr/share/yui/yuicompressor-2.4.7.jar --type js --line-break 200 -o tmp/js/10_jcarousellite.js  js/plugins/jcarousellite-1-0-1.js
cp js/plugins/jcarousellite-1-0-1-min.js tmp/js/10_jcarousellite.js
java -jar /usr/share/yui/yuicompressor.jar --type js --line-break 200 -o tmp/js/20_wp-polls.js  js/plugins/wp-polls.js
java -jar /usr/share/yui/yuicompressor.jar --type js --line-break 200 -o tmp/js/30_init.js      js/init.js
java -jar /usr/share/yui/yuicompressor.jar --type js --line-break 200 -o js/lab-min.js      js/lab-prod.js

cat tmp/js/* > js/vr-min.js

rm -rf tmp

echo 'Ta dan!'
