@extends('welcome')

@section('css')
<style type="text/css">
.col-md-12{
	position: relative;
min-height: 1px;
padding-right: 15px;
padding-left: 15px;
}

.row {
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-6 {
    width: 50%;
}

.post-name-css {
    font-size: 15px;
    text-decoration: none !important;
    font-weight: 500;
    color: dimgray !important;
    margin: 8px;
}
.post-title-new {
    font-weight: 500;
    color: dodgerblue;
    font-size: 15px;
    text-decoration: none;
    margin: 8px;
}

.post-content-css {
    font-size: 13px;
    text-decoration: none !important;
    font-weight: 500;
    color: dimgray !important;
    margin: 8px;
}
.post-detail-css {
    font-size: 13px;
    text-decoration: none !important;
    font-weight: 500;
    color: dimgray !important;
    margin: 8px;
}

/* ------------------------------------- 
        GLOBAL 
------------------------------------- */
* { 
    margin:0;
    padding:0;
}
* { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }

img { 
    max-width: 100%; 
}
.collapse {
    margin:0;
    padding:0;
}
body {
    -webkit-font-smoothing:antialiased; 
    -webkit-text-size-adjust:none; 
    width: 100%!important; 
    height: 100%;
}


/* ------------------------------------- 
        ELEMENTS 
------------------------------------- */
a { color: white;}

.btn {
    text-decoration:none;
    color: #FFF;
    background-color: #666;
    padding:10px 16px;
    font-weight:bold;
    margin-right:10px;
    text-align:center;
    cursor:pointer;
    display: inline-block;
}

p.callout {
    padding:15px;
    background-color:#ECF8FF;
    margin-bottom: 15px;
}
.callout a {
    font-weight:bold;
    color: #2BA6CB;
}

table.social {
/*  padding:15px; */
    background-color: #56787B;
    
}
.social .soc-btn {
    padding: 5px 10px;
    font-size: 12px;
    margin-bottom: 10px;
    text-decoration: none;
    color: #FFF;
    font-weight: bold;
     display: block; 
    text-align: center;
}

a.fb { background-color: #3861B7!important; }
a.tw { background-color: #02B0FF!important; }
a.gp { background-color: #DB4A39!important; }
a.ms { background-color: #000!important; }

.sidebar .soc-btn { 
    display:block;
    width:100%;
}

/* ------------------------------------- 
        HEADER 
------------------------------------- */
table.head-wrap { width: 100%;}

.header.container table td.logo { padding: 15px; }
.header.container table td.label { padding: 15px; padding-left:0px;}


/* ------------------------------------- 
        BODY 
------------------------------------- */
table.body-wrap { width: 100%;}


/* ------------------------------------- 
        FOOTER 
------------------------------------- */
table.footer-wrap { width: 100%;    clear:both!important;
}
.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
.footer-wrap .container td.content p {
    font-size:10px;
    font-weight: bold;
    
}


/* ------------------------------------- 
        TYPOGRAPHY 
------------------------------------- */
h1,h2,h3,h4,h5,h6 {
font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
}
h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

h1 { font-weight:200; font-size: 44px;}
h2 { font-weight:200; font-size: 37px;}
h3 { font-weight:500; font-size: 27px;}
h4 { font-weight:500; font-size: 23px;}
h5 { font-weight:900; font-size: 17px;}
h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

.collapse { margin:0!important;}

p, ul { 
    margin-bottom: 10px; 
    font-weight: normal; 
    font-size:14px; 
    line-height:1.6;
    color: whitesmoke;
}
p.lead { font-size:17px; }
p.last { margin-bottom:0px;}

ul li {
    margin-left:5px;
    list-style-position: inside;
}

/* ------------------------------------- 
        SIDEBAR 
------------------------------------- */
ul.sidebar {
    background:#ebebeb;
    display:block;
    list-style-type: none;
}
ul.sidebar li { display: block; margin:0;}
ul.sidebar li a {
    text-decoration:none;
    color: #666;
    padding:10px 16px;
/*  font-weight:bold; */
    margin-right:10px;
/*  text-align:center; */
    cursor:pointer;
    border-bottom: 1px solid #777777;
    border-top: 1px solid #FFFFFF;
    display:block;
    margin:0;
}
ul.sidebar li a.last { border-bottom-width:0px;}
ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}



/* --------------------------------------------------- 
        RESPONSIVENESS
        Nuke it from orbit. It's the only way to be sure. 
------------------------------------------------------ */

/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
    display:block!important;
    max-width:600px!important;
    /*margin:0 auto!important; /* makes it centered */
    clear:both!important;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
    padding:15px;
    max-width:600px;
    margin:0 auto;
    display:block; 
}

/* Let's make sure tables in the content area are 100% wide */
.content table { width: 100%; }


/* Odds and ends */
.column {
    width: 300px;
    float:left;
}
.column tr td { padding: 15px; }
.column-wrap { 
    padding:0!important; 
    margin:0 auto; 
    max-width:600px!important;
}
.column table { width:100%;}
.social .column {
    width: 280px;
    min-width: 279px;
    float:left;
}

/* Be sure to place a .clear element after each set of columns, just to be safe */
.clear { display: block; clear: both; }


/* ------------------------------------------- 
        PHONE
        For clients that support media queries.
        Nothing fancy. 
-------------------------------------------- */
@media only screen and (max-width: 600px) {
    
    a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

    div[class="column"] { width: auto!important; float:none!important;}
    
    table.social div[class="column"] {
        width:auto!important;
    }

}


.apply-css{
        background-color: #21BDAF;
    color: white;
    padding: 10px 60px;
    border-radius: 5px !important;
    margin: 15px 0 0 0;
}
</style>
@stop
 @section('content')


 <div style="margin: 10px 20px;color:dimgrey;">
    <h4>Hi, </h4>
<p style="color:dimgrey;">I found below job opprtunity matching your skills. </p>

<h3>Job Title</h3> 
(min exp- max exp yrs)<br/>
Company name:<br/>
location:<br/>
Required Skills: s1, s2<br/>
Posted by: post Owner name on post dttime<br/>

<a href="http://jobtip.in" class="btn apply-css">Contact</a>
</div>
<!-- BODY -->


<!-- FOOTER -->
<table class="footer-wrap">
    <tr>
        <td></td>
        <td class="container">
            
                <!-- content -->
                <div class="content">
                <table>
                    <tr>
                        <td>
                            <img src="/assets/jobtip-banner.jpg"/>
                        </td>
                    </tr>
               
            </table>
                </div><!-- /content -->
                
        </td>
        <td></td>
    </tr>
</table><!-- /FOOTER -->
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">

            <div class="content">
            <table>
                <tr>
                    <td>
                        <!-- social & contact -->
                        <table class="social" width="100%" style="background-color:#444">
                            <tr>
                                <td>
                                    
                                    <!--- column 1 -->
                                    <table align="left" class="column">
                                        <tr>
                                            <td>                
                                                
                                                <h5 style=" color: #EAEAEA;font-weight: 500;">Connect with Us:</h5>
                                                <p class=""><a href="http://jobtip.in/facebook" class="soc-btn fb">Facebook</a> <a href="http://jobtip.in/linkedin" class="soc-btn tw">Linkedin</a> <a href="http://jobtip.in/google" class="soc-btn gp">Google+</a></p>
                        
                                                
                                            </td>
                                        </tr>
                                    </table><!-- /column 1 -->  
                                    
                                    <!--- column 2 -->
                                    <table align="left" class="column">
                                        <tr>
                                            <td>                
                                                                            
                                                <h5 style=" color: #EAEAEA;font-weight: 500;">Contact Info:</h5>                                             
                                                <p>
                                                    <strong>
                                                                <a href="emailto:connect@jobtip.in" style="    background-color: #21bdaf;
    padding: 3px 10px;
    text-decoration: none;
    display: block;
    text-align: center;
    font-weight: 400;
    font-size: 14px;    margin: 10px 0;">
                                                                    connect@jobtip.in
                                                                </a>
                                                            </strong>
                                                             <strong>
                                                                <a href="emailto:connect@jobtip.in" style="    background-color: #21bdaf;
    padding: 3px 10px;
    text-decoration: none;
    display: block;
    text-align: center;
    font-weight: 400;
    font-size: 14px;    margin: 10px 0;">
                                                                    info@jobtip.in
                                                                </a>
                                                            </strong>
                                                             <strong>
                                                                <a href="emailto:connect@jobtip.in" style="    background-color: #21bdaf;
    padding: 3px 10px;
    text-decoration: none;
    display: block;
    text-align: center;
    font-weight: 400;
    font-size: 14px;    margin: 10px 0;">
                                                                    +91 11111 11111
                                                                </a>
                                                            </strong>
                                                </p>
                
                                            </td>
                                        </tr>
                                        
                                    </table><!-- /column 2 -->
                                    
                                    <span class="clear"></span> 
                                    
                                </td>
                            </tr>
                             <tr>
                    <td align="center" style="border-top: 1px dotted #46E5FF;">
                        <p style="color:darkblue;">
                            <a href="jobtip.in/termcondition" target="_blank" style="color: #00CEFF;">Terms</a> |
                            <a href="jobtip.in/privacyprolicy" target="_blank" style="color: #00CEFF;">Privacy</a> |
                            <a href="#" style="color: #00CEFF;"><unsubscribe>Unsubscribe</unsubscribe></a>
                        </p>
                    </td>
                </tr>
                        </table><!-- /social & contact -->
                    
                    
                    </td>
                </tr>
            </table>
            </div>
                                    
        </td>
        <td></td>
    </tr>
</table><!-- /BODY -->
@stop