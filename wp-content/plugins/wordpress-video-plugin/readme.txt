=== Wordpress Video Plugin ===
Contributors: daburna
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YFLULRR6CR99G
Tags: embedding, Video, embed, portal, Youtube, Sevenload, Google, MyVideo, Clipfish, Revver, Yahoo!, Brightcove, Aniboom, MSN, Liveleak, Collegehumor, slideshare, guba, GoalVideoz  
Requires at least: 2.0.0
Tested up to: 3.2.1
Stable tag: 0.756

A filter for WordPress that displays videos from many video services.

== Description ==

A filter for WordPress that allows easy video embedding of supported sites. Support for 65 different video sites. 

The following sites are supported:

* 123video.nl
* Aniboom
* Blip.tv
* Break
* Brightcove
* CBS
* Cellfish
* Clipfish
* Clipsyndicate
* Collegehumor
* ComedyCentral.com
* current.com
* D1G.com
* dotSUB
* Facebook
* Flickr Video
* FunnyorDie.com
* GameTrailers
* GameVideos
* Generic Flash
* Glumbert
* GoalVideoz
* Google Video
* Grouper
* Guba
* Hamburg1 Video
* hulu
* IFILM
* ISeeIt.TV
* Jumpcut
* Kewego
* Last.fm
* LiveLeak
* MEGAVIDEO
* Metacafe
* Mncast.com
* Mojvideo.com
* MPORA.com
* MQSTO.com
* MSN
* MyspaceTV
* MyVideo
* Novamov
* OnSMASH.com
* reason.tv
* ReelzChannel
* Revver
* screencast-o-matic.com
* Sevenload
* slideshare.com
* smotri.com
* Sumo.tv
* teachertube
* Trilulilu
* Tu.tv
* UnCut
* Veoh
* Videotube
* Vimeo
* Vsocial
* vzaar.com
* Wandeo
* wat.tv
* Yahoo! Video
* Youreporter
* Youtube
* Youtube Playlist

== Installation ==

Copy the file videos.php into the wp-content/plugins folder of your WordPress installation. 
After that go to Administration page, choose Plugins. Wordpress Video Plugin should be in the list. 
Activtate it.


== Using the plugin ==

You can find the freshest instruction here: http://www.daburna.de/dokuwiki/doku.php/instruction.
Please tell me your wishes: http://www.daburna.de/dokuwiki/doku.php/wishlist.

MyVideo: 
- every occurence of the expression [myvideo id width height] (case unsensitive) will start as
an embedded flash player. Replace "id" with the MyVideo id. For the URL 
http://www.myvideo.de/watch/366128, the id part is 366128

youtube:
- every occurence of the expression [youtube id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the youtube id. For the URL 
http://youtube.com/watch?v=83FWE_qBudU, the id part is 83FWE_qBudU

The default width and height is definded in "define("YOUTUBE_WIDTH", 425)" and
"define("YOUTUBE_HEIGHT", 350)". To change the default size, simply edit the
values. Additionally you can add the desired width and height to the expression
seperated by spaces (i.e. [youtube id 300 150].

For the URL http://youtube.com/watch?v=83FWE_qBudU, the id part is 83FWE_qBudU,
so a valid tag would be "[youtube 83FWE_qBudU]" or for a smaller player size then
the default dimensions "[youtube 83FWE_qBudU 210 175]"


google video:
- every occurence of the expression [google id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the google video id. For the URL
http://video.google.de/videoplay?docid=5024787479139933029, the id part is 5024787479139933029

clipfish:
- every occurence of the expression [clipfish id width height] (case unsensitive) will start as
an embedded flash player. Replace "id" with the clipfish id. For the URL
http://www.clipfish.de/channel/253/video/2834485/das-schaeferlied-von-schaefer-heinrich/, the id part is 2834485

sevenload:
- every occurence of the expression [sevenload id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the sevenload id. For the URL
http://sevenload.de/videos/8A6KASF-arif-playback, the id part is 8A6KASF

dailymotion:
- every occurence of the expression [dailymotion id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the dailymotion id or the video URL (both works).

The default width and height is definded in "define("DAILYMOTION_WIDTH", 420)" and
"define("DAILYMOTION_HEIGHT", 336)". To change the default size, simply edit the
values. Additionally you can add the desired width and height to the expression
seperated by spaces (i.e. [dailymotion id 300 150].

For the URL http://dailymotion.com/video/xbxov2_hello-geekette, the id part is xbxov2,
so a valid tag would be "[dailymotion xbxov2]" or even "[dailymotion http://dailymotion.com/video/xbxov2_hello-geekette]
or for a smaller player size then the default dimensions "[dailymotion xbxov2 210 175]"

BREAK.com:
- every occurence of the expression [break id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Break id. It is a little bit difficult to get
the id. You will find it, when you copy the video code for an embeded player. Look for this line: 
<param name="movie" value="http://embed.break.com/MjI2NTkx">, there you can find the id: MjI2NTkx  

METACAFE.com:
- every occurence of the expression [metacafe id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Metacafe id. For the URL
http://www.metacafe.com/watch/427425/boulot/, the id part is 427425

VIMEO.com:
- every occurence of the expression [vimeo id width height] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Vimeo id. For the URL
http://www.vimeo.com/138920, the id part is 138920

Videotube.de:
- every occurence of the expression [videotube id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Videotube id. For the URL
http://www.videotube.de/ci/page/player/527, the id part is 527


BLIP.tv:
- every occurence of the expression [bliptv id width height] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Blip.tv id. You will find it, 
when you copy the video code for an embeded player. Look for this line: <embed src="http://blip.tv/play/gvFH8rZBgvNh" 
For the URL http://blip.tv/file/1865111, the id part is gvFH8rZBgvNh 

REVVER.com:
- every occurence of the expression [revver id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Revver id. For the URL
http://one.revver.com/watch/174453, the id part is 174453

UnCut.com:
- every occurence of the expression [uncut id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the UnCut id. For the URL
http://uncutvideo.aol.com/videos/16ea5688332b7df5a5dc5ba6a99f4d3d, the id part is 
16ea5688332b7df5a5dc5ba6a99f4d3d

GROUPER.com:
- every occurence of the expression [grouper id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Grouper id. For the URL
http://grouper.com/video/MediaDetails.aspx?id=1759771&ml=o%3D0%26t%3D1%26fx%3D%26fp%3D2%26fmx%3D3%26rnd%3D3, 
the id part is 1759771

LIVELEAK.com:
- every occurence of the expression [liveleak id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Liveleak id. For the URL
http://www.liveleak.com/view?i=8d3_1181986751, the id part is 8d3_1181986751

IFILM.com
- every occurence of the expression [ifilm id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the IFILM id. For the URL
http://www.ifilm.com/video/2878371, the id part is 2878371

GameTrailers
- every occurence of the expression [gametrailers id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the GAMETRAILERS id. For the URL 
http://gametrailers.com/player/22271.html, the id part is 22271

GameVideos
- every occurence of the expression [gamevideos id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the GAMEVIDEOS id. For the URL  
http://www.gamevideos.com/video/id/13217, the id part is 13217

GLUMBERT.com
- every occurence of the expression [glumbert id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the GLUMBERT id. For the URL  
http://www.glumbert.com/media/spidermate, the id part is spidermate

WANDEO.com
- just copy the code from the box: "on my wordpress blog" e.g. [wandeo 0b61aa57760d51eab7b9a58adc16d0a3]

VEOH.com
- every occurence of the expression [veoh id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the VEOH id. For the URL 
http://www.veoh.com/videos/v849683cxDDQm7y, the id part is v849683cxDDQm7y

MYSPACETV
- every occurence of the expression [myspacetv id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the MYSPACETV id. For the URL 
http://vids.myspace.com/index.cfm?fuseaction=vids.individual&VideoID=11315224, the id part is 11315224

Yahoo! Video
- every occurence of the expression [yahoo id width height] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Yahoo! Video id. It is a little bit difficult to get
the id. You will find it, when you copy the video code for an embeded player. Look for this line:
flashvars='id=3253032&emailUrl=http%3A%2F%2...etc..., there you can find the id: 3253032

Tu.TV
- every occurence of the expression [tutv id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Tu.tv id. It is a little bit difficult to get
the id. You will find it, when you copy the video code for an embeded player. Look for this line:
...tutvweb.swf?kpt=aHR0cDovL3d3dy50dS50di92aWRlb3Njb2RpL2MvaS9jaWNsaXN0YS1hYnVzaXZvLmZsdg==&x..., 
there you can find the id: aHR0cDovL3d3dy50dS50di92aWRlb3Njb2RpL2MvaS9jaWNsaXN0YS1hYnVzaXZvLmZsdg
 
Cellfish.com
- every occurence of the expression [cellfish id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Cellfish id. For the URL 
http://cellfish.cellfish.com/multimedia/97749, the id part is 97749

Aniboom
- every occurence of the expression [aniboom id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Aniboom id. For the URL 
http://www.aniboom.com/Player.aspx?v=1905, the id part is 1905

Brightcove
- every occurence of the expression [brightcove id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the Brightcove id. For the URL
http://link.brightcove.com/services/player/bcpid416542555?bctid=24776439001, the id part is
24776439001 -> [brightcove 24776439001]

123video.nl
- every occurence of the expression [123videonl id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the 123video.nl id. For the URL
http://123video.nl/playvideos.asp?MovieID=132273, the id part is 132273

Sumo.tv
- every occurence of the expression [sumotv id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the sumo.tv id. It is a little bit difficult to get
the id. You will find it, when you copy the video code for an embeded player. Look for this line:
<param name="flashVars" value="file=00/01/200710049164669307.flv&autostart=true">there you can find the id:
00/01/200710049164669307

last.fm
- every occurence of the expression [lastfm id] (case unsensitive) will start as
an embedded flash player. Replace "id" with the last.fm id. It is a little bit difficult to get
the id. You will find it, when you copy the video code for an embeded player. Look for this line:
<param name="flashvars" value="embed=true&creator=Kettcar&title=Landungsbr%C3%BCcken+raus&uniqueName=Landungsbr%C3%BCcken+raus&albumArt=http://cdn.last.fm/coverart/130x130/1422004.jpg&album=Du+Und+Wieviel+Von+Deinen+Freunden&duration=257&image=http://panther3.last.fm/storable/videocap/15582/0/original.jpg&FSSupport=true" />
the id is:
embed=true&creator=Kettcar&title=Landungsbr%C3%BCcken+raus&uniqueName=Landungsbr%C3%BCcken+raus&albumArt=http://cdn.last.fm/coverart/130x130/1422004.jpg&album=Du+Und+Wieviel+Von+Deinen+Freunden&duration=257&image=http://panther3.last.fm/storable/videocap/15582/0/original.jpg&FSSupport=trueS

Vsocial:
[vsocial id]
URL: http://www.vsocial.com/video/?d=106492 ->id=106492 

teachertube:
[teachertube id]
URL: http://www.teachertube.com/view_video.php?viewkey=2c8b64f1380e2a11d84f  but look here: [flashvideo width="425" height="350" filename="http://www.teachertube.com/flvideo/11926.flv" /] ->id=11926

slideshare:
[slideshare id]
Replace "id" with the corresponding values from the URL of the object. For embedding the presentation at 
http://www.slideshare.net/jboutelle/slidecasting-101 just click on 'Post to Wordpress' and you will get this code
[slideshare id=82836&doc=slidecasting-1013073]

Comedycentral:
[comedycentral id]
http://www.comedycentral.com/videos/index.jhtml?videoId=393382&title=comic-con-2011-panel---live-table-read -> [comedycentral 393382]

Reason.tv:
[reason id]
http://reason.tv/video/show/157.html -> [reason 157]

Jumpcut:
[jumpcut id width height]
http://jumpcut.com/view/?id=774D8BB8E95911DA897BFEAF976EA1AD -> [jumpcut 774D8BB8E95911DA897BFEAF976EA1AD]

Collegehumor:
[collegehumor id width height]
http://www.collegehumor.com/video:1727961 -> [collegehumor 1727961]

Hamburg1 Video:
[hamburg1 id width height]
http://www.hamburg1video.de/video/iLyROoaftT81.html -> [hamburg1 iLyROoaftT81]

mncast.com:
[mncast id width height]
the id is in the embed code. search for "movieID". for http://www.mncast.com/?4223906 -> [mncast 10005583920080301233042]

Youtube Playlist:
[youtubeplaylist id width height] 
http://de.youtube.com/view_play_list?p=EF1145687A8B929B -> [youtubeplaylist EF1145687A8B929B]

MSN:
[msn id width height]
http://video.msn.com/video.aspx?vid=71e6a055-7b68-4fc3-880a-1bcffe1433b5 -> [msn 71e6a055-7b68-4fc3-880a-1bcffe1433b5]

MEGAVIDEO:
[megavideo id width height]
http://www.megavideo.com/?v=Q0G3U6F7 -> [megavideo Q0G3U6F7]

ReelzChannel:
[reelzchannel id width height]
http://www.reelzchannel.com/video/32097/indiana-jones-4-trailer -> [reelzchannel 32097]

d1g.com:
[d1g id width height]
http://www.d1g.com/video/show/1912587 -> [d1g 1912587]

Trilulilu:
[trilulilu id width height]
http://www.trilulilu.ro/keskifa/d219752d57c01e -> [trilulilu d219752d57c01e]

Funny or Die:
[funnyordie id width height]
http://www.funnyordie.com/videos/3b1e3750e2 -> [funnyordie 3b1e3750e2]

Generic Flash:
[flash id width height]]
http://www.messe-ideen.de/upload/magische-zauberkugel.swf -> [flash http://www.messe-ideen.de/upload/magische-zauberkugel.swf]

Youreporter:
[youreporter id]
http://www.youreporter.it/view_video.php?viewkey=dac8bc8ba637133b2c65 -> [youreporter dac8bc8ba637133b2c65]

Clipsyndicate:
[Clipsyndicate id width height]
http://www.clipsyndicate.com/publish/video/613132/raw_video_tornado_destroys_iowa_bank?wpid=0 -> [clipsyndicate 613132]

Mojvideo.com:
[mojvideo id width height]
http://www.mojvideo.com/video-bmw-club-obsotelje/480f35d6e4c046353a58 -> [mojvideo 480f35d6e4c046353a58]

GoalVideoz:
[goalvideoz id width height]
http://www.goalvideoz.com/watch/2674-Portugal-vs-Turkey-2nd-Half-Goals-and-Highlights-Euro-2008/ -> [goalvideoz 2674]

Guba:
[guba id width geight]
http://www.guba.com/watch/3000093083?duration_step=0&featured=featuredsportsvids&filter_tiny=0&pp=10&sb=8&set=5&sf=0&size_step=0&o=2&sample=1213474809:9b2e64c91768e700634a0248b8c9ee758ff0bd27 -> [guba 3000093083]

wat.tv:
[wat id width height]
http://www.wat.tv/video/ouverture-mondial-presse-automoto-z9po_z1vx_.html -> You will find the id, when you copy the video code for an embeded player. Look 
for this line: <param name="movie" value="http://www.wat.tv/swf2/313547fagwuFO1645548" /> there you find the id. It is 313547fagwuFO1645548 -> [wat 313547fagwuFO1645548]

smotri.com
[smotri id width height]
http://smotri.com/video/view/?id=v630387892f -> [smotri v630387892f] 

OnSMASH
[onsmash id width height]
http://videos.onsmash.com/v/3X8RTKaK6C3hya7q -> [onsmash 3X8RTKaK6C3hya7q] 

dotSUB
[dotsub id width height]
http://dotsub.com/view/7774e495-71c5-4a64-83d9-28675d835d90 -> [dotsub 7774e495-71c5-4a64-83d9-28675d835d90]

screencast-o-matic
[screencast id width height]
http://www.screencast-o-matic.com/watch/cii3lYtk -> [screencast cii3lYtk]

current
[current id width height]
http://current.com/items/89891774/supernews_twouble_with_twitters.htm -> [current 89891774]

Facebook
[FB id]
http://www.facebook.com/video/video.php?v=1036384564453 -> [FB 1036384564453]

Flickr Video
[flickr id width height]
http://www.flickr.com/photos/25530364@N07/3599198949/in/pool-alongphoto -> [flickr 3599198949]

Kewego
[kewego id width height]
http://www.kewego.de/video/iLyROoaftxTc.html -> [kewego iLyROoaftxTc]

Novamov
[novamov id]
http://www.novamov.com/video/oaqqzqx1czqg5 -> [novamov oaqqzqx1czqg5]

ISeeIt.TV
[iseeitv id [width height]]
e.g. [iseeittv cqns7lq0g6ua0p]

hulu
[hulu id width height]
You find the id when you copy the video code for the an embedded player. Look for this line near the beginning of the code:
<object width="480" height="270"><param name="movie" value="http://www.hulu.com/embed/KqGQAaGmZu7EaRstGkKYXQ">
[hulu KqGQAaGmZu7EaRstGkKYXQ]
NOTE: Hulu currenly works only in the US.

CBS
[cbs id width height]
http://www.cbs.com/late_night/late_show/video/?pid=jBKco1lLmfitxBLY9pzs9RDOb1k0paQO&nrd=1 -> [cbs jBKco1lLmfitxBLY9pzs9RDOb1k0paQO]
NOTE: CBS currenly works only in the US.

MQSTO.com
[mqstovideocom id]
http://mqsto.com/video/18830 -> [mqstovideocom 18830]

vzaar.com
[vzaar id width height]
http://vzaar.com/videos/541684 -> [vzaar 541684]

mpora.com
[mpora id width height]
http://video.mpora.com/watch/Q9lVFPNia/ -> [mpora Q9lVFPNia]

== Changelog ==

= 0.756 - 18.10.2011 =
* added support for:
- mpora

* updated code for:
- comedycentral
- google (fullscreen allowed, size changed)
- youtube playlist (iframe)

= 0.755 - 17.05.2011 =
* added support for:
- vzaar
* updated code for:
- Bliptv (is now iframe; made width & height configurable)
- Sumo.tv
* updated donate link
* added first implementation of an option page for administrators

= 0.754 - 28.01.2011 =
* bugfix for YouTube: wrong fullscreen-tag crashes iframe
* added support for: MQSTO.com code by bedio

= 0.753 - 21.01.2011 =
* updated code for YouTube; new standard is iframe

= 0.752 - 13.11.2010 =
* updated code for:
- Generic Flash Code by Francisco Monteagudo
- Facebook allows Fullscreen
- bugfix for  wrong size declaration at Dailymotion
- youtube encoding is now en_US

= 0.751 - 18.10.2010 =
* Bugfix for wrong header 
* corrected version numbers

= 0.75 - 13.10.2010 =
* added support for:
- ISeeIt.TV (code by David Fudge http://www.testarca.de)
- hulu (code by James Kass http://www.chucklehutch.com)
- CBS (code by James Kass http://www.chucklehutch.com)
* updated code for:
- brightcove (new player and size)
- vimeo (supports iPad, iPhone, Flash and beyond)

= 0.744 - 20.07.2010 - bugfix release =
* removed code for Youtube channel (maybe this caused the problems)

= 0.743 - 15.07.2010 - bugfix release =
* corrected missing arguments for 'generic_flash_plugin' and 'tt_plugin_mu'
* removed German sentences at Youtube Channel
* smaller standard videosize for youtube 425 x 344, because small blogs got problems with the bigger size

= 0.74 - 14.07.2010 =
* added Youtube channel (code by Eric Hartmann http://erichartmann.de/?page_id=5)
* added the_excerpt for every site
* updated code for youtube
- strict XHTML
- new standard videosize is 560 x 340

= 0.73 - 06.02.2010 =
* updated code for
- dailymotion (by dailymotion team; New IDs, check your old IDs!)
- slideshare (by Graham)

= 0.72 - 26.01.2010 =
* updated code for
- MySpaceTV (fullscreen + bigger size)
- Sevenload
- Clipfish
* added donate link at readme
* updated plugin info text (link to instruction page + quickguide)
* added support for novamov.com

= 0.71 - 30.06.2009 =
* updated code for brightcove (instruction update!)
* added history at readme file
* added support for:
- Facebook Video (code by roberto scano http://robertoscano.info)
- Flickr Video (code by an anonymous user)
- Kewego (code by Renaud Boyer)

= 0.70 - 24.03.2009 =
* added support for:
- screencast-o-matic
- current

* updated code:
- liveleak
- slideshare (The code has essentially changed. You embedded old presentations need an id update!)
- blip.tv (Maybe the old embedded videos need an id update after upgrading.)

= 0.69 - 03.01.2009 =
* added support for:
- OnSMASH
- dotSUB

* updated code:
- youtube: fullscreen is now possible
- myvideo: configuring size & fullscreen is possible
- clipfish: configuring size & fullscreen is possible
- yahoo!: configuring size & fullscreen is possible
- fixed a bug at vimeo code -> http://wordpress.org/support/topic/208723

= 0.68 - 04.10.2008 =
* added support for:
- wat.tv by Bertimus (http://www.born2buzz.com/)
- smotri.com
* fixed bug "errors in archives" -> http://wordpress.org/support/topic/183928

= 0.67 - 14.06.2008 =
* added support for:
- Generic Flash by Francisco Monteagudo
- youreporter by Giacomo
- clipsyndicate.com by Antonio SJ Musumeci
- Mojvideo.com
- GoalVideoz
- Guba

* added ability to show videos at rss feed
* updated veoh.com code

= 0.66 - 06.04.2008 =
* added support for:
- MEGAVIDEO
- ReelzChannel
- d1g.com
- Trilulilu
- Funny or Die
* removed stage6 code; site is shutdown
* updated code for vimeo 

= 0.65 - 10.03.2008 =
* fixed bug on line 119 and 92
* fixed problem with fullscreen player for dailymotion

= 0.64 - 02.03.2008 =
* added support for:
- mncast.com
- youtube playlist
- msn (soapbox)

= 0.63 - 29.12.2007 =
* added support for:
- Jumpcut
- Collegehumor
- Hamburg1 Video

= 0.62 - 28.11.2007 =
* added support for:
- comedycentral by Antonio (http://www.landofbile.com/blog/)
- reason.tv by Antonio 

= 0.61 - 25.11.2007 =
* added support for:
- implemented size by <a href="http://www.dickes-en.de">Wolfgang Neikes</a> 
- vsocial
- teachertube by -drmike
- SlideShare developed by <a href="www.mikrosklave.net">Peter Weiland</a>, included by <a href="http://www.bertdesign.de/blog">Markus Bertling</a>
* first try of making flashplayersize configurable -->test it with youtube

= 0.60 - 15.10.2007 =
* added support for:
- last.fm
- Sumo.tv
* testing svn-access to worpress plugin directory

= 0.57 - 05.10.2007 =
* added support for:
- Aniboom
- Brightcove
- 123video.nl

= 0.56 - 16.08.2007 =
* added support for:
- Cellfish.com

= 0.55 - 31.07.2007 =
* added support for:
- tu.tv
- Stage6

= 0.54 - 28.07.2007 =
* added support for:
- Yahoo! Video
- myspacetv
- IFILM.com
- VEOH.com
- GameTrailers.com - thanks to Johno
- GameVideos.com - thanks to Johno
- Glumbert - thanks to Dwayne Bailey
- Wandeo - thanks to PyPe

= 0.53 - 16.06.2007 =
* added support for LiveLeak.com - thanks to Whiteman

= 0.52 - 18.02.2007 =
* added patch for youtube ids, which were converted wrong, thanks to Sigve Indregard from http://indregard.no

= 0.51 - 17.02.2007 =
* renamed the plugin -> now it works with update plugin
* videos from videotube should not auto play anymore

= 0.5 - 15.02.2007 =
* added support for:
- break.com
- metacafe
- vimeo
- videotube
- blip.tv
- revver
- UnCut
- Grouper

* hopefully solved overlapping problem

= 0.4 - 28.12.2006 =
* added support for:
- sevenload
- dailymotion

= 0.3 - 15.12.2006 =
* removed wrong code for youtube videos
* better support for clipfish

= 0.2 - 13.12.2006 =
* first official version of this plugin
* added support for:
- MyVideo
- Clipfish

= 0.1 - 13.12.2006 =
* first version
* support for:
- Youtube
- Google Video
