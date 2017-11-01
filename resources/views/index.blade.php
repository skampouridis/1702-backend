<!DOCTYPE html><html><head><meta charset="utf-8"><title>Vessel Track Rest API</title><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"><style>@import url('https://fonts.googleapis.com/css?family=Roboto:400,700|Inconsolata|Raleway:200');@import url('https://fonts.googleapis.com/css?family=Roboto:100,400,700|Source+Code+Pro');.hljs-comment,.hljs-title{color:#8e908c}.hljs-variable,.hljs-attribute,.hljs-tag,.hljs-regexp,.ruby .hljs-constant,.xml .hljs-tag .hljs-title,.xml .hljs-pi,.xml .hljs-doctype,.html .hljs-doctype,.css .hljs-id,.css .hljs-class,.css .hljs-pseudo{color:#c82829}.hljs-number,.hljs-preprocessor,.hljs-pragma,.hljs-built_in,.hljs-literal,.hljs-params,.hljs-constant{color:#f5871f}.ruby .hljs-class .hljs-title,.css .hljs-rules .hljs-attribute{color:#eab700}.hljs-string,.hljs-value,.hljs-inheritance,.hljs-header,.ruby .hljs-symbol,.xml .hljs-cdata{color:#718c00}.css .hljs-hexcolor{color:#3e999f}.hljs-function,.python .hljs-decorator,.python .hljs-title,.ruby .hljs-function .hljs-title,.ruby .hljs-title .hljs-keyword,.perl .hljs-sub,.javascript .hljs-title,.coffeescript .hljs-title{color:#4271ae}.hljs-keyword,.javascript .hljs-function{color:#8959a8}.hljs{display:block;background:white;color:#4d4d4c;padding:.5em}.coffeescript .javascript,.javascript .xml,.tex .hljs-formula,.xml .javascript,.xml .vbscript,.xml .css,.xml .hljs-cdata{opacity:.5}.right .hljs-comment{color:#969896}.right .css .hljs-class,.right .css .hljs-id,.right .css .hljs-pseudo,.right .hljs-attribute,.right .hljs-regexp,.right .hljs-tag,.right .hljs-variable,.right .html .hljs-doctype,.right .ruby .hljs-constant,.right .xml .hljs-doctype,.right .xml .hljs-pi,.right .xml .hljs-tag .hljs-title{color:#c66}.right .hljs-built_in,.right .hljs-constant,.right .hljs-literal,.right .hljs-number,.right .hljs-params,.right .hljs-pragma,.right .hljs-preprocessor{color:#de935f}.right .css .hljs-rule .hljs-attribute,.right .ruby .hljs-class .hljs-title{color:#f0c674}.right .hljs-header,.right .hljs-inheritance,.right .hljs-name,.right .hljs-string,.right .hljs-value,.right .ruby .hljs-symbol,.right .xml .hljs-cdata{color:#b5bd68}.right .css .hljs-hexcolor,.right .hljs-title{color:#8abeb7}.right .coffeescript .hljs-title,.right .hljs-function,.right .javascript .hljs-title,.right .perl .hljs-sub,.right .python .hljs-decorator,.right .python .hljs-title,.right .ruby .hljs-function .hljs-title,.right .ruby .hljs-title .hljs-keyword{color:#81a2be}.right .hljs-keyword,.right .javascript .hljs-function{color:#b294bb}.right .hljs{display:block;overflow-x:auto;background:#1d1f21;color:#c5c8c6;padding:.5em;-webkit-text-size-adjust:none}.right .coffeescript .javascript,.right .javascript .xml,.right .tex .hljs-formula,.right .xml .css,.right .xml .hljs-cdata,.right .xml .javascript,.right .xml .vbscript{opacity:.5}.hljs-comment{color:#969896}.css .hljs-class,.css .hljs-id,.css .hljs-pseudo,.hljs-attribute,.hljs-regexp,.hljs-tag,.hljs-variable,.html .hljs-doctype,.ruby .hljs-constant,.xml .hljs-doctype,.xml .hljs-pi,.xml .hljs-tag .hljs-title{color:#77A619}.hljs-literal{color:#A69819}.hljs-built_in,.hljs-constant,.hljs-number,.hljs-params,.hljs-pragma,.hljs-preprocessor{color:#1B88B3}.css .hljs-rule .hljs-attribute,.ruby .hljs-class .hljs-title{color:#A37518}.hljs-header,.hljs-inheritance,.hljs-name,.hljs-string,.hljs-value,.ruby .hljs-symbol,.xml .hljs-cdata{color:inherit}.coffeescript .hljs-title,.css .hljs-hexcolor,.hljs-function,.hljs-title,.javascript .hljs-title,.perl .hljs-sub,.python .hljs-decorator,.python .hljs-title,.ruby .hljs-function .hljs-title,.ruby .hljs-title .hljs-keyword{color:#A63A4A}.hljs-keyword,.javascript .hljs-function{color:#A69819}.hljs{display:block;overflow-x:auto;background:#1d1f21;color:#c5c8c6;padding:.5em;-webkit-text-size-adjust:none}.coffeescript .javascript,.javascript .xml,.tex .hljs-formula,.xml .css,.xml .hljs-cdata,.xml .javascript,.xml .vbscript{opacity:.5}.right .hljs-comment{color:#969896}.right .css .hljs-class,.right .css .hljs-id,.right .css .hljs-pseudo,.right .hljs-attribute,.right .hljs-regexp,.right .hljs-tag,.right .hljs-variable,.right .html .hljs-doctype,.right .ruby .hljs-constant,.right .xml .hljs-doctype,.right .xml .hljs-pi,.right .xml .hljs-tag .hljs-title{color:#C1EF65}.right .hljs-literal{color:#EBDE68}.right .hljs-built_in,.right .hljs-constant,.right .hljs-number,.right .hljs-params,.right .hljs-pragma,.right .hljs-preprocessor{color:#77BCD7}.right .css .hljs-rule .hljs-attribute,.right .ruby .hljs-class .hljs-title{color:#f0c674}.right .hljs-header,.right .hljs-inheritance,.right .hljs-name,.right .hljs-string,.right .hljs-value,.right .ruby .hljs-symbol,.right .xml .hljs-cdata{color:inherit}.right .coffeescript .hljs-title,.right .css .hljs-hexcolor,.right .hljs-function,.right .hljs-title,.right .javascript .hljs-title,.right .perl .hljs-sub,.right .python .hljs-decorator,.right .python .hljs-title,.right .ruby .hljs-function .hljs-title,.right .ruby .hljs-title .hljs-keyword{color:#f099a6}.right .hljs-keyword,.right .javascript .hljs-function{color:#EBDE68}.right .hljs{display:block;overflow-x:auto;background:#1d1f21;color:#c5c8c6;padding:.5em;-webkit-text-size-adjust:none}.right .coffeescript .javascript,.right .javascript .xml,.right .tex .hljs-formula,.right .xml .css,.right .xml .hljs-cdata,.right .xml .javascript,.right .xml .vbscript{opacity:.5}body{color:#4c555a;background:white;font:400 14px / 1.42 'Roboto',Helvetica,sans-serif}header{border-bottom:1px solid transparent;margin-bottom:12px}h1,h2,h3,h4,h5{color:#292e31;margin:12px 0}h1 .permalink,h2 .permalink,h3 .permalink,h4 .permalink,h5 .permalink{margin-left:0;opacity:0;transition:opacity .25s ease}h1:hover .permalink,h2:hover .permalink,h3:hover .permalink,h4:hover .permalink,h5:hover .permalink{opacity:1}.triple h1 .permalink,.triple h2 .permalink,.triple h3 .permalink,.triple h4 .permalink,.triple h5 .permalink{opacity:.15}.triple h1:hover .permalink,.triple h2:hover .permalink,.triple h3:hover .permalink,.triple h4:hover .permalink,.triple h5:hover .permalink{opacity:.15}h1{font:100 36px 'Roboto',Helvetica,sans-serif;font-size:36px}h2{font:100 36px 'Roboto',Helvetica,sans-serif;font-size:30px}h3{font-size:100%;text-transform:uppercase}h5{font-size:100%;font-weight:normal}p{margin:0 0 10px}p.choices{line-height:1.6}a{color:#0099e5;text-decoration:none}li p{margin:0}hr.split{border:0;height:1px;width:100%;padding-left:6px;margin:12px auto;background-image:linear-gradient(to right, rgba(76,85,90,0) 20%, rgba(76,85,90,0.2) 48%, rgba(221,228,232,0.2) 48%, rgba(221,228,232,0) 80%)}dl dt{float:left;width:130px;clear:left;text-align:right;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-weight:700}dl dd{margin-left:150px}blockquote{color:rgba(76,85,90,0.5);font-size:15.5px;padding:10px 20px;margin:12px 0;border-left:5px solid #e8e8e8}blockquote p:last-child{margin-bottom:0}pre{background-color:#f5f5f5;padding:12px;border:1px solid #cfcfcf;border-radius:3px;overflow:auto}pre code{color:#4c555a;background-color:transparent;padding:0;border:none}code{color:#b93d6a;background-color:#f5f5f5;font:13px / 19.5px 'Source Code Pro',Menlo,monospace;padding:1px 4px;border:1px solid #cfcfcf;border-radius:3px}ul,ol{padding-left:2em}table{border-collapse:collapse;border-spacing:0;margin-bottom:12px}table tr:nth-child(2n){background-color:#fafafa}table th,table td{padding:6px 12px;border:1px solid #e6e6e6}.text-muted{opacity:.5}.note,.warning{padding:.3em 1em;margin:1em 0;border-radius:2px;font-size:90%}.note h1,.warning h1,.note h2,.warning h2,.note h3,.warning h3,.note h4,.warning h4,.note h5,.warning h5,.note h6,.warning h6{font-family:100 36px 'Roboto',Helvetica,sans-serif;font-size:135%;font-weight:500}.note p,.warning p{margin:.5em 0}.note{color:#4c555a;background-color:#ebf7fd;border-left:4px solid #0099e5}.note h1,.note h2,.note h3,.note h4,.note h5,.note h6{color:#0099e5}.warning{color:#4c555a;background-color:#faf0f4;border-left:4px solid #B82E5F}.warning h1,.warning h2,.warning h3,.warning h4,.warning h5,.warning h6{color:#B82E5F}header{margin-top:24px}nav{position:fixed;top:24px;bottom:0;overflow-y:auto}nav .resource-group{padding:0}nav .resource-group .heading{position:relative}nav .resource-group .heading .chevron{position:absolute;top:12px;right:12px;opacity:.5}nav .resource-group .heading a{display:block;color:#4c555a;opacity:.7;border-left:2px solid transparent;margin:0}nav .resource-group .heading a:hover{text-decoration:underline;background-color:transparent;border-left:2px solid transparent}nav ul{list-style-type:none;padding-left:0}nav ul a{display:block;font-size:13px;color:rgba(76,85,90,0.7);padding:8px 12px;border-top:1px solid transparent;border-left:2px solid transparent;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}nav ul a:hover{text-decoration:underline;background-color:transparent;border-left:2px solid transparent}nav ul>li{margin:0}nav ul>li:first-child{margin-top:-12px}nav ul>li:last-child{margin-bottom:-12px}nav ul ul a{padding-left:24px}nav ul ul li{margin:0}nav ul ul li:first-child{margin-top:0}nav ul ul li:last-child{margin-bottom:0}nav>div>div>ul>li:first-child>a{border-top:none}.preload *{transition:none !important}.pull-left{float:left}.pull-right{float:right}.badge{display:inline-block;float:right;min-width:10px;min-height:14px;padding:3px 7px;font-size:12px;color:black;background-color:transparent;border-radius:10px;margin:-2px -8px -2px 0}.badge.get{color:#fff;background-color:#ddf1fc}.badge.head{color:#fff;background-color:#ddf1fc}.badge.options{color:#fff;background-color:#ddf1fc}.badge.put{color:#fff;background-color:#f7f2c3}.badge.patch{color:#fff;background-color:#f7f2c3}.badge.post{color:#fff;background-color:#e4f2c8}.badge.delete{color:#fff;background-color:#f2d8e1}.collapse-button{float:right}.collapse-button .close{display:none;color:#0099e5;cursor:pointer}.collapse-button .open{color:#0099e5;cursor:pointer}.collapse-button.show .close{display:inline}.collapse-button.show .open{display:none}.collapse-content{max-height:0;overflow:hidden;transition:max-height .3s ease-in-out}nav{width:220px}.container{max-width:940px;margin-left:auto;margin-right:auto}.container .row .content{margin-left:244px;width:696px}.container .row:after{content:'';display:block;clear:both}.container-fluid nav{width:22%}.container-fluid .row .content{margin-left:24%}.container-fluid.triple nav{width:15%;padding-right:1px}.container-fluid.triple .row .content{position:relative;margin-left:15%;padding-left:24px}.middle:before,.middle:after{content:'';display:table}.middle:after{clear:both}.middle{box-sizing:border-box;width:48%;padding-right:12px}.right{box-sizing:border-box;float:right;width:52%;padding-left:12px}.right a{color:#0099e5}.right h1,.right h2,.right h3,.right h4,.right h5,.right p,.right div{color:#dde4e8}.right pre{background-color:#272B2D;border:1px solid #272B2D}.right pre code{color:#D0D0D0}.right .description{margin-top:12px}.triple .resource-heading{font-size:125%}.definition{margin-top:12px;margin-bottom:12px}.definition .method{font-weight:bold}.definition .method.get{color:#2e8ab8}.definition .method.head{color:#2e8ab8}.definition .method.options{color:#2e8ab8}.definition .method.post{color:#8ab82e}.definition .method.put{color:#b8aa2e}.definition .method.patch{color:#b8aa2e}.definition .method.delete{color:#b82e5f}.definition .uri{word-break:break-all;word-wrap:break-word}.definition .hostname{opacity:.5}.example-names{background-color:#eee;padding:12px;border-radius:3px}.example-names .tab-button{cursor:pointer;color:#4c555a;border:1px solid #ddd;padding:6px;margin-left:12px}.example-names .tab-button.active{background-color:#d5d5d5}.right .example-names{background-color:#424648}.right .example-names .tab-button{color:#dde4e8;border:1px solid #6C6F71;border-radius:3px}.right .example-names .tab-button.active{background-color:#5a6063}#nav-background{position:fixed;left:0;top:0;bottom:0;width:15%;padding-right:14.4px;background-color:#fafcfc;border-right:1px solid #f0f4f7;z-index:-1}#right-panel-background{position:absolute;right:-12px;top:-12px;bottom:-12px;width:52%;background-color:#2d3134;z-index:-1}@media (max-width:1200px){nav{width:198px}.container{max-width:840px}.container .row .content{margin-left:224px;width:606px}}@media (max-width:992px){nav{width:169.4px}.container{max-width:720px}.container .row .content{margin-left:194px;width:526px}}@media (max-width:768px){nav{display:none}.container{width:95%;max-width:none}.container .row .content,.container-fluid .row .content,.container-fluid.triple .row .content{margin-left:auto;margin-right:auto;width:95%}#nav-background{display:none}#right-panel-background{width:52%}}.back-to-top{position:fixed;z-index:1;bottom:0;right:24px;padding:4px 8px;color:rgba(76,85,90,0.5);background-color:transparent;text-decoration:none !important;border-top:1px solid transparent;border-left:1px solid transparent;border-right:1px solid transparent;border-top-left-radius:3px;border-top-right-radius:3px}.resource-group{padding:12px 12px 12px 0;margin-bottom:12px;background-color:transparent;border:1px solid transparent;border-radius:3px}.resource-group h2.group-heading,.resource-group .heading a{padding:12px 12px 12px 0;margin:0 0 12px 0;background-color:transparent;border-bottom:1px solid transparent;border-top-left-radius:3px;border-top-right-radius:3px;white-space:nowrap;text-overflow:ellipsis;overflow:hidden}.triple .content .resource-group{padding:0;border:none}.triple .content .resource-group h2.group-heading,.triple .content .resource-group .heading a{margin:0 0 12px 0;border:1px solid transparent}nav .resource-group .heading a{padding:12px;margin-bottom:0}nav .resource-group .collapse-content{padding:0}.action{margin-bottom:12px;padding:12px 12px 0 12px;overflow:hidden;border:1px solid transparent;border-radius:3px}.action h4.action-heading{padding:6px 12px;margin:-12px -12px 12px -12px;border-bottom:1px solid transparent;border-top-left-radius:3px;border-top-right-radius:3px;overflow:hidden}.action h4.action-heading .name{float:right;font-weight:normal;padding:6px 0}.action h4.action-heading .method{padding:6px 12px;margin-right:12px;border-radius:2px;display:inline-block}.action h4.action-heading .method.get{color:#fff;background-color:#0099e5}.action h4.action-heading .method.head{color:#fff;background-color:#0099e5}.action h4.action-heading .method.options{color:#fff;background-color:#0099e5}.action h4.action-heading .method.put{color:#fff;background-color:#b1a74e}.action h4.action-heading .method.patch{color:#fff;background-color:#b1a74e}.action h4.action-heading .method.post{color:#fff;background-color:#85a546}.action h4.action-heading .method.delete{color:#fff;background-color:#c14a74}.action h4.action-heading code{color:#444;background-color:#f5f5f5;border-color:#cfcfcf;font-weight:normal;word-break:break-all;display:inline-block;margin-top:2px}.action dl.inner{padding-bottom:2px}.action .title{border-bottom:1px solid transparent;margin:0 -12px -1px -12px;padding:12px}.action.get{border-color:#ddf1fc}.action.get h4.action-heading{color:#0099e5;background:#ddf1fc;border-bottom-color:#ddf1fc}.action.head{border-color:#ddf1fc}.action.head h4.action-heading{color:#0099e5;background:#ddf1fc;border-bottom-color:#ddf1fc}.action.options{border-color:#ddf1fc}.action.options h4.action-heading{color:#0099e5;background:#ddf1fc;border-bottom-color:#ddf1fc}.action.post{border-color:#e4f2c8}.action.post h4.action-heading{color:#85a546;background:#e4f2c8;border-bottom-color:#e4f2c8}.action.put{border-color:#f7f2c3}.action.put h4.action-heading{color:#b1a74e;background:#f7f2c3;border-bottom-color:#f7f2c3}.action.patch{border-color:#f7f2c3}.action.patch h4.action-heading{color:#b1a74e;background:#f7f2c3;border-bottom-color:#f7f2c3}.action.delete{border-color:#f2d8e1}.action.delete h4.action-heading{color:#c14a74;background:#f2d8e1;border-bottom-color:#f2d8e1}</style></head><body class="preload"><div id="nav-background"></div><div class="container-fluid triple"><div class="row"><nav><div class="resource-group"><div class="heading"><div class="chevron"><i class="open fa fa-angle-down"></i></div><a href="#clients">Clients</a></div><div class="collapse-content"><ul><li><a href="#clients-clients-collection-get"><span class="badge get"><i class="fa fa-arrow-down"></i></span>Clients Collection</a></li><li><a href="#clients-client-object-get"><span class="badge get"><i class="fa fa-arrow-down"></i></span>Client Object</a></li></ul></div></div><div class="resource-group"><div class="heading"><div class="chevron"><i class="open fa fa-angle-down"></i></div><a href="#vessels">Vessels</a></div><div class="collapse-content"><ul><li><a href="#vessels-vessels-collection-get"><span class="badge get"><i class="fa fa-arrow-down"></i></span>Vessels Collection</a></li><li><a href="#vessels-vessel-object-get"><span class="badge get"><i class="fa fa-arrow-down"></i></span>Vessel Object</a></li></ul></div></div><div class="resource-group"><div class="heading"><div class="chevron"><i class="open fa fa-angle-down"></i></div><a href="#searches">Searches</a></div><div class="collapse-content"><ul><li><a href="#searches-seaches-collection-get"><span class="badge get"><i class="fa fa-arrow-down"></i></span>Seaches Collection</a></li><li><a href="#searches-seach-object-get"><span class="badge get"><i class="fa fa-arrow-down"></i></span>Seach Object</a></li><li><a href="#searches-seach-request-post"><span class="badge post"><i class="fa fa-plus"></i></span>Seach Request</a></li></ul></div></div><div class="resource-group"><div class="heading"><div class="chevron"><i class="open fa fa-angle-down"></i></div><a href="#vessel-tracks">Vessel Tracks</a></div><div class="collapse-content"><ul><li><a href="#vessel-tracks-vessels-tracks-collection-get"><span class="badge get"><i class="fa fa-arrow-down"></i></span>Vessels Tracks Collection</a></li><li><a href="#vessel-tracks-vessel-track-object-get"><span class="badge get"><i class="fa fa-arrow-down"></i></span>Vessel Track Object</a></li></ul></div></div><p style="text-align: center; word-wrap: break-word;"><a href="https://www.manoloudis.gr/marine/api">https://www.manoloudis.gr/marine/api</a></p></nav><div class="content"><div id="right-panel-background"></div><div class="middle"><header><h1 id="top">Vessel Track Rest API</h1></header></div><div class="right"><h5>API Endpoint</h5><a href="https://www.manoloudis.gr/marine/api">https://www.manoloudis.gr/marine/api</a></div><div class="middle"><p>API documentation with supported routes</p>
</div><div class="middle"><section id="clients" class="resource-group"><h2 class="group-heading">Clients <a href="#clients" class="permalink">&para;</a></h2></section></div><div class="middle"><div id="clients-clients-collection" class="resource"><h3 class="resource-heading">Clients Collection <a href="#clients-clients-collection" class="permalink">&para;</a></h3></div></div><div class="right"><div class="definition"><span class="method get">GET</span>&nbsp;<span class="uri"><span class="hostname">https://www.manoloudis.gr/marine/api</span>/clients</span></div><div class="tabs"><div class="tabs"><div class="example-names"><span>Responses</span><span class="tab-button">200</span></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">[
    {
      "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">2</span></span>,
      "<span class="hljs-attribute">ip</span>": <span class="hljs-value"><span class="hljs-string">"10.0.0.1"</span>
    </span>},
    {
      "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
      "<span class="hljs-attribute">ip</span>": <span class="hljs-value"><span class="hljs-string">"127.0.0.1"</span>
    </span>}
  ]
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
  "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
      "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
        "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
          </span>}</span>,
          "<span class="hljs-attribute">ip</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span>
          </span>}
        </span>}
      </span>}
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div></div></div></div><div class="middle"><div id="clients-clients-collection-get" class="action get"><h4 class="action-heading"><div class="name">Clients Collection</div><a href="#clients-clients-collection-get" class="method get">GET</a><code class="uri">/clients</code></h4><p>Displays Collection of All Clients.</p>
</div></div><hr class="split"><div class="middle"><div id="clients-client-object" class="resource"><h3 class="resource-heading">Client Object <a href="#clients-client-object" class="permalink">&para;</a></h3></div></div><div class="right"><div class="definition"><span class="method get">GET</span>&nbsp;<span class="uri"><span class="hostname">https://www.manoloudis.gr/marine/api</span>/clients/<span class="hljs-attribute" title="id">1</span></span></div><div class="tabs"><div class="tabs"><div class="example-names"><span>Responses</span><span class="tab-button">200</span><span class="tab-button">404</span></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
    "<span class="hljs-attribute">ip</span>": <span class="hljs-value"><span class="hljs-string">"127.0.0.1"</span></span>,
    "<span class="hljs-attribute">searches</span>": <span class="hljs-value">[
      {
        "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">11</span></span>,
        "<span class="hljs-attribute">client_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
        "<span class="hljs-attribute">lon_from</span>": <span class="hljs-value"><span class="hljs-number">15</span></span>,
        "<span class="hljs-attribute">lon_to</span>": <span class="hljs-value"><span class="hljs-number">16</span></span>,
        "<span class="hljs-attribute">lat_from</span>": <span class="hljs-value"><span class="hljs-number">36</span></span>,
        "<span class="hljs-attribute">lat_to</span>": <span class="hljs-value"><span class="hljs-number">37</span></span>,
        "<span class="hljs-attribute">time_from</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-17 22:03:21"</span></span>,
        "<span class="hljs-attribute">time_to</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-20 20:03:21"</span></span>,
        "<span class="hljs-attribute">results</span>": <span class="hljs-value"><span class="hljs-number">92</span></span>,
        "<span class="hljs-attribute">created_at</span>": <span class="hljs-value"><span class="hljs-string">"2017-11-01 00:03:13"</span>
      </span>}
    ]
  </span>}
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
  "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
    </span>}</span>,
    "<span class="hljs-attribute">ip</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span>
    </span>}</span>,
    "<span class="hljs-attribute">searches</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
      "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
        "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
          </span>}</span>,
          "<span class="hljs-attribute">client_id</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
          </span>}</span>,
          "<span class="hljs-attribute">lon_from</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
          </span>}</span>,
          "<span class="hljs-attribute">lon_to</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
          </span>}</span>,
          "<span class="hljs-attribute">lat_from</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
          </span>}</span>,
          "<span class="hljs-attribute">lat_to</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
          </span>}</span>,
          "<span class="hljs-attribute">time_from</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
          </span>}</span>,
          "<span class="hljs-attribute">time_to</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
          </span>}</span>,
          "<span class="hljs-attribute">results</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
          </span>}</span>,
          "<span class="hljs-attribute">created_at</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
          </span>}
        </span>}
      </span>}
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">error</span>": <span class="hljs-value"><span class="hljs-string">"Not Found."</span>
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
  "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">error</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span>
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div></div></div></div><div class="middle"><div id="clients-client-object-get" class="action get"><h4 class="action-heading"><div class="name">Client Object</div><a href="#clients-client-object-get" class="method get">GET</a><code class="uri">/clients/{id}</code></h4><p>Displays Sinlge Client Object</p>
<div class="title"><strong>URI Parameters</strong><div class="collapse-button show"><span class="close">Hide</span><span class="open">Show</span></div></div><div class="collapse-content"><dl class="inner"><dt>id</dt><dd><code>string</code>&nbsp;<span class="required">(required)</span>&nbsp;<span class="text-muted example"><strong>Example:&nbsp;</strong><span>1</span></span><p>The Client ID</p>
</dd></dl></div></div></div><hr class="split"><div class="middle"><section id="vessels" class="resource-group"><h2 class="group-heading">Vessels <a href="#vessels" class="permalink">&para;</a></h2></section></div><div class="middle"><div id="vessels-vessels-collection" class="resource"><h3 class="resource-heading">Vessels Collection <a href="#vessels-vessels-collection" class="permalink">&para;</a></h3></div></div><div class="right"><div class="definition"><span class="method get">GET</span>&nbsp;<span class="uri"><span class="hostname">https://www.manoloudis.gr/marine/api</span>/vessels</span></div><div class="tabs"><div class="tabs"><div class="example-names"><span>Responses</span><span class="tab-button">200</span></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">[
    {
      "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
      "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value"><span class="hljs-number">247039300</span>
    </span>},
    {
      "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">2</span></span>,
      "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value"><span class="hljs-number">311040700</span>
    </span>},
    {
      "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">3</span></span>,
      "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value"><span class="hljs-number">311486000</span>
    </span>}
  ]
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
  "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
      "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
        "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
          </span>}</span>,
          "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
          </span>}
        </span>}
      </span>}
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div></div></div></div><div class="middle"><div id="vessels-vessels-collection-get" class="action get"><h4 class="action-heading"><div class="name">Vessels Collection</div><a href="#vessels-vessels-collection-get" class="method get">GET</a><code class="uri">/vessels</code></h4><p>Displays Collection of All Vessels.</p>
</div></div><hr class="split"><div class="middle"><div id="vessels-vessel-object" class="resource"><h3 class="resource-heading">Vessel Object <a href="#vessels-vessel-object" class="permalink">&para;</a></h3></div></div><div class="right"><div class="definition"><span class="method get">GET</span>&nbsp;<span class="uri"><span class="hostname">https://www.manoloudis.gr/marine/api</span>/vessels/<span class="hljs-attribute" title="id">1</span></span></div><div class="tabs"><div class="tabs"><div class="example-names"><span>Responses</span><span class="tab-button">200</span><span class="tab-button">404</span></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
    "<span class="hljs-attribute">ip</span>": <span class="hljs-value"><span class="hljs-string">"127.0.0.1"</span></span>,
    "<span class="hljs-attribute">tracks</span>": <span class="hljs-value">[
      {
        "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">518</span></span>,
        "<span class="hljs-attribute">vessel_id</span>": <span class="hljs-value"><span class="hljs-number">2</span></span>,
        "<span class="hljs-attribute">status</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
        "<span class="hljs-attribute">speed</span>": <span class="hljs-value"><span class="hljs-number">198</span></span>,
        "<span class="hljs-attribute">lon</span>": <span class="hljs-value"><span class="hljs-number">34.65781</span></span>,
        "<span class="hljs-attribute">lat</span>": <span class="hljs-value"><span class="hljs-number">33.56754</span></span>,
        "<span class="hljs-attribute">course</span>": <span class="hljs-value"><span class="hljs-number">55</span></span>,
        "<span class="hljs-attribute">heading</span>": <span class="hljs-value"><span class="hljs-number">56</span></span>,
        "<span class="hljs-attribute">rot</span>": <span class="hljs-value"><span class="hljs-string">"NULL"</span></span>,
        "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-17 22:07:05"</span>
      </span>}
    ]</span>,
    "<span class="hljs-attribute">searches</span>": <span class="hljs-value">[
      {
        "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">11</span></span>,
        "<span class="hljs-attribute">client_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
        "<span class="hljs-attribute">lon_from</span>": <span class="hljs-value"><span class="hljs-number">15</span></span>,
        "<span class="hljs-attribute">lon_to</span>": <span class="hljs-value"><span class="hljs-number">16</span></span>,
        "<span class="hljs-attribute">lat_from</span>": <span class="hljs-value"><span class="hljs-number">36</span></span>,
        "<span class="hljs-attribute">lat_to</span>": <span class="hljs-value"><span class="hljs-number">37</span></span>,
        "<span class="hljs-attribute">time_from</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-17 22:03:21"</span></span>,
        "<span class="hljs-attribute">time_to</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-20 20:03:21"</span></span>,
        "<span class="hljs-attribute">results</span>": <span class="hljs-value"><span class="hljs-number">92</span></span>,
        "<span class="hljs-attribute">created_at</span>": <span class="hljs-value"><span class="hljs-string">"2017-11-01 00:03:13"</span>
      </span>}
    ]
  </span>}
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
    "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
        </span>}</span>,
        "<span class="hljs-attribute">ip</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span>
        </span>}</span>,
        "<span class="hljs-attribute">tracks</span>" : <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
            "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
                "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">vessel_id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">status</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">speed</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">lon</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                    "<span class="hljs-attribute">lat</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                    "<span class="hljs-attribute">course</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">heading</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">rot</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span></span>}</span>,
                    "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span></span>}
                </span>}
            </span>}
        </span>}
        <span class="hljs-string">"searches"</span> : {
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
            "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
                "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">client_id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">lon_from</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                    "<span class="hljs-attribute">lon_to</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                    "<span class="hljs-attribute">lat_from</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                    "<span class="hljs-attribute">lat_to</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                    "<span class="hljs-attribute">time_from</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span></span>}</span>,
                    "<span class="hljs-attribute">time_to</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span></span>}</span>,
                    "<span class="hljs-attribute">results</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">created_at</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span></span>}
                </span>}
            </span>}
        </span>}
    </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">error</span>": <span class="hljs-value"><span class="hljs-string">"Not Found."</span>
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
  "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">error</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span>
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div></div></div></div><div class="middle"><div id="vessels-vessel-object-get" class="action get"><h4 class="action-heading"><div class="name">Vessel Object</div><a href="#vessels-vessel-object-get" class="method get">GET</a><code class="uri">/vessels/{id}</code></h4><p>Displays Sinlge Vessel Object with searches and tracks.</p>
<div class="title"><strong>URI Parameters</strong><div class="collapse-button show"><span class="close">Hide</span><span class="open">Show</span></div></div><div class="collapse-content"><dl class="inner"><dt>id</dt><dd><code>string</code>&nbsp;<span class="required">(required)</span>&nbsp;<span class="text-muted example"><strong>Example:&nbsp;</strong><span>1</span></span><p>The Vessel ID</p>
</dd></dl></div></div></div><hr class="split"><div class="middle"><section id="searches" class="resource-group"><h2 class="group-heading">Searches <a href="#searches" class="permalink">&para;</a></h2></section></div><div class="middle"><div id="searches-seaches-collection" class="resource"><h3 class="resource-heading">Seaches Collection <a href="#searches-seaches-collection" class="permalink">&para;</a></h3></div></div><div class="right"><div class="definition"><span class="method get">GET</span>&nbsp;<span class="uri"><span class="hostname">https://www.manoloudis.gr/marine/api</span>/searches</span></div><div class="tabs"><div class="tabs"><div class="example-names"><span>Responses</span><span class="tab-button">200</span></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">[
    {
      "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">11</span></span>,
      "<span class="hljs-attribute">client_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
      "<span class="hljs-attribute">lon_from</span>": <span class="hljs-value"><span class="hljs-number">15</span></span>,
      "<span class="hljs-attribute">lon_to</span>": <span class="hljs-value"><span class="hljs-number">16</span></span>,
      "<span class="hljs-attribute">lat_from</span>": <span class="hljs-value"><span class="hljs-number">36</span></span>,
      "<span class="hljs-attribute">lat_to</span>": <span class="hljs-value"><span class="hljs-number">37</span></span>,
      "<span class="hljs-attribute">time_from</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-17 22:03:21"</span></span>,
      "<span class="hljs-attribute">time_to</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-20 20:03:21"</span></span>,
      "<span class="hljs-attribute">results</span>": <span class="hljs-value"><span class="hljs-number">92</span></span>,
      "<span class="hljs-attribute">created_at</span>": <span class="hljs-value"><span class="hljs-string">"2017-11-01 00:03:13"</span></span>,
      "<span class="hljs-attribute">vessels</span>": <span class="hljs-value">[
        {
          "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">2</span></span>,
          "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value"><span class="hljs-number">311040700</span></span>,
          "<span class="hljs-attribute">pivot</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">search_id</span>": <span class="hljs-value"><span class="hljs-number">11</span></span>,
            "<span class="hljs-attribute">vessel_id</span>": <span class="hljs-value"><span class="hljs-number">2</span>
          </span>}
        </span>}
      ]
    </span>}
  ]
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
  "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
      "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
        "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
          </span>}</span>,
          "<span class="hljs-attribute">lon_from</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
          </span>}</span>,
          "<span class="hljs-attribute">lon_to</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
          </span>}</span>,
          "<span class="hljs-attribute">lat_from</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
          </span>}</span>,
          "<span class="hljs-attribute">lat_to</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
          </span>}</span>,
          "<span class="hljs-attribute">time_from</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
          </span>}</span>,
          "<span class="hljs-attribute">time_to</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
          </span>}</span>,
          "<span class="hljs-attribute">results</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
          </span>}</span>,
          "<span class="hljs-attribute">created_at</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
          </span>}</span>,
          "<span class="hljs-attribute">vessels</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
            "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
              "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
              "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
                  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
                </span>}</span>,
                "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value">{
                  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
                </span>}</span>,
                "<span class="hljs-attribute">pivot</span>": <span class="hljs-value">{
                  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
                  "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">search_id</span>": <span class="hljs-value">{
                      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
                    </span>}</span>,
                    "<span class="hljs-attribute">vessel_id</span>": <span class="hljs-value">{
                      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
                    </span>}
                  </span>}
                </span>}
              </span>}
            </span>}
          </span>}
        </span>}
      </span>}
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div></div></div></div><div class="middle"><div id="searches-seaches-collection-get" class="action get"><h4 class="action-heading"><div class="name">Seaches Collection</div><a href="#searches-seaches-collection-get" class="method get">GET</a><code class="uri">/searches</code></h4><p>Displays Collection of All Search Requests.</p>
</div></div><hr class="split"><div class="middle"><div id="searches-seach-object" class="resource"><h3 class="resource-heading">Seach Object <a href="#searches-seach-object" class="permalink">&para;</a></h3></div></div><div class="right"><div class="definition"><span class="method get">GET</span>&nbsp;<span class="uri"><span class="hostname">https://www.manoloudis.gr/marine/api</span>/searches/</span></div><div class="tabs"><div class="tabs"><div class="example-names"><span>Responses</span><span class="tab-button">200</span><span class="tab-button">404</span></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">11</span></span>,
    "<span class="hljs-attribute">client_id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
    "<span class="hljs-attribute">lon_from</span>": <span class="hljs-value"><span class="hljs-number">15</span></span>,
    "<span class="hljs-attribute">lon_to</span>": <span class="hljs-value"><span class="hljs-number">16</span></span>,
    "<span class="hljs-attribute">lat_from</span>": <span class="hljs-value"><span class="hljs-number">36</span></span>,
    "<span class="hljs-attribute">lat_to</span>": <span class="hljs-value"><span class="hljs-number">37</span></span>,
    "<span class="hljs-attribute">time_from</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-17 22:03:21"</span></span>,
    "<span class="hljs-attribute">time_to</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-20 20:03:21"</span></span>,
    "<span class="hljs-attribute">results</span>": <span class="hljs-value"><span class="hljs-number">92</span></span>,
    "<span class="hljs-attribute">created_at</span>": <span class="hljs-value"><span class="hljs-string">"2017-11-01 00:03:13"</span></span>,
    "<span class="hljs-attribute">vessels</span>": <span class="hljs-value">[
      {
        "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">2</span></span>,
        "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value"><span class="hljs-number">311040700</span></span>,
        "<span class="hljs-attribute">pivot</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">search_id</span>": <span class="hljs-value"><span class="hljs-number">11</span></span>,
          "<span class="hljs-attribute">vessel_id</span>": <span class="hljs-value"><span class="hljs-number">2</span>
        </span>}
      </span>}
    ]</span>,
    "<span class="hljs-attribute">tracks</span>": <span class="hljs-value">[
      {
        "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">2542</span></span>,
        "<span class="hljs-attribute">vessel_id</span>": <span class="hljs-value"><span class="hljs-number">3</span></span>,
        "<span class="hljs-attribute">status</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
        "<span class="hljs-attribute">speed</span>": <span class="hljs-value"><span class="hljs-number">146</span></span>,
        "<span class="hljs-attribute">lon</span>": <span class="hljs-value"><span class="hljs-number">15.00804</span></span>,
        "<span class="hljs-attribute">lat</span>": <span class="hljs-value"><span class="hljs-number">36.29868</span></span>,
        "<span class="hljs-attribute">course</span>": <span class="hljs-value"><span class="hljs-number">91</span></span>,
        "<span class="hljs-attribute">heading</span>": <span class="hljs-value"><span class="hljs-number">92</span></span>,
        "<span class="hljs-attribute">rot</span>": <span class="hljs-value"><span class="hljs-string">"NULL"</span></span>,
        "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-18 16:51:57"</span></span>,
        "<span class="hljs-attribute">pivot</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">search_id</span>": <span class="hljs-value"><span class="hljs-number">11</span></span>,
          "<span class="hljs-attribute">vessel_track_id</span>": <span class="hljs-value"><span class="hljs-number">2542</span>
        </span>}
      </span>}
    ]
  </span>}
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
  "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
      "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
        </span>}</span>,
        "<span class="hljs-attribute">lon_from</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
        </span>}</span>,
        "<span class="hljs-attribute">lon_to</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
        </span>}</span>,
        "<span class="hljs-attribute">lat_from</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
        </span>}</span>,
        "<span class="hljs-attribute">lat_to</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
        </span>}</span>,
        "<span class="hljs-attribute">time_from</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
        </span>}</span>,
        "<span class="hljs-attribute">time_to</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
        </span>}</span>,
        "<span class="hljs-attribute">results</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
        </span>}</span>,
        "<span class="hljs-attribute">created_at</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
        </span>}</span>,
        "<span class="hljs-attribute">vessels</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
          "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
            "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
              "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
              </span>}</span>,
              "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
              </span>}</span>,
              "<span class="hljs-attribute">pivot</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
                "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
                  "<span class="hljs-attribute">search_id</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
                  </span>}</span>,
                  "<span class="hljs-attribute">vessel_id</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
                  </span>}
                </span>}
              </span>}
            </span>}
          </span>}
        </span>}</span>,
        "<span class="hljs-attribute">tracks</span>": <span class="hljs-value">{
          "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
          "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
            "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
              "<span class="hljs-attribute">id</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
              </span>}</span>,
              "<span class="hljs-attribute">vessel_id</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
              </span>}</span>,
              "<span class="hljs-attribute">status</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
              </span>}</span>,
              "<span class="hljs-attribute">speed</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
              </span>}</span>,
              "<span class="hljs-attribute">lon</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
              </span>}</span>,
              "<span class="hljs-attribute">lat</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span>
              </span>}</span>,
              "<span class="hljs-attribute">course</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
              </span>}</span>,
              "<span class="hljs-attribute">heading</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
              </span>}</span>,
              "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span>
              </span>}</span>,
              "<span class="hljs-attribute">pivot</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
                "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
                  "<span class="hljs-attribute">search_id</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
                  </span>}</span>,
                  "<span class="hljs-attribute">vessel_id</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span>
                  </span>}
                </span>}
              </span>}
            </span>}
          </span>}
        </span>}
      </span>}
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">error</span>": <span class="hljs-value"><span class="hljs-string">"Not Found."</span>
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
  "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">error</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span>
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div></div></div></div><div class="middle"><div id="searches-seach-object-get" class="action get"><h4 class="action-heading"><div class="name">Seach Object</div><a href="#searches-seach-object-get" class="method get">GET</a><code class="uri">/searches/</code></h4><p>Displays Single Search Object with Vessel Tracks response.</p>
</div></div><hr class="split"><div class="middle"><div id="searches-seach-request" class="resource"><h3 class="resource-heading">Seach Request <a href="#searches-seach-request" class="permalink">&para;</a></h3></div></div><div class="right"><div class="definition"><span class="method post">POST</span>&nbsp;<span class="uri"><span class="hostname">https://www.manoloudis.gr/marine/api</span>/search</span></div><div class="tabs"><div class="example-names"><span>Requests</span><span class="tab-button">example 1</span></div><div class="tab"><div><div class="inner"><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">vessels</span>": <span class="hljs-value">[
    <span class="hljs-number">311486000</span>,
    <span class="hljs-number">311040700</span>
  ]</span>,
  "<span class="hljs-attribute">location</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">lat</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">from</span>": <span class="hljs-value"><span class="hljs-string">"36"</span></span>,
      "<span class="hljs-attribute">to</span>": <span class="hljs-value"><span class="hljs-string">"37"</span>
    </span>}</span>,
    "<span class="hljs-attribute">lon</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">from</span>": <span class="hljs-value"><span class="hljs-string">"23"</span></span>,
      "<span class="hljs-attribute">to</span>": <span class="hljs-value"><span class="hljs-string">"24"</span>
    </span>}
  </span>}</span>,
  "<span class="hljs-attribute">time</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">from</span>": <span class="hljs-value"><span class="hljs-string">"2017-10-15 10:00:00"</span></span>,
    "<span class="hljs-attribute">to</span>": <span class="hljs-value"><span class="hljs-string">"2017-10-24 10:00:00"</span>
  </span>}</span>,
  "<span class="hljs-attribute">response_from</span>": <span class="hljs-value"><span class="hljs-string">"json"</span>
</span>}</code></pre><div style="height: 1px;"></div></div></div><div class="tabs"><div class="example-names"><span>Responses</span><span class="tab-button">200</span><span class="tab-button">208</span><span class="tab-button">209</span><span class="tab-button">408</span><span class="tab-button">409</span></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">[
    {
      "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">2677</span></span>,
      "<span class="hljs-attribute">status</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
      "<span class="hljs-attribute">speed</span>": <span class="hljs-value"><span class="hljs-number">144</span></span>,
      "<span class="hljs-attribute">lon</span>": <span class="hljs-value"><span class="hljs-string">"15.96756"</span></span>,
      "<span class="hljs-attribute">lat</span>": <span class="hljs-value"><span class="hljs-string">"36.25863"</span></span>,
      "<span class="hljs-attribute">course</span>": <span class="hljs-value"><span class="hljs-number">92</span></span>,
      "<span class="hljs-attribute">heading</span>": <span class="hljs-value"><span class="hljs-number">93</span></span>,
      "<span class="hljs-attribute">rot</span>": <span class="hljs-value"><span class="hljs-string">"NULL"</span></span>,
      "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-18 20:03:21"</span></span>,
      "<span class="hljs-attribute">vessel</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">3</span></span>,
        "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value"><span class="hljs-number">311486000</span>
      </span>}
    </span>}
  ]
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
    "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
            "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">status</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">speed</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">lon</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                "<span class="hljs-attribute">lat</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                "<span class="hljs-attribute">course</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">heading</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">rot</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span></span>}</span>,
                "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span></span>}</span>,
                "<span class="hljs-attribute">vessel</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
                    "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
                        "<span class="hljs-attribute">id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                        "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    }
                </span>}
            </span>}
        </span>}
    </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/xml</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code><span class="hljs-pi">&lt;?xml version="1.0"?&gt;</span>
<span class="hljs-tag">&lt;<span class="hljs-title">root</span>&gt;</span>
    <span class="hljs-tag">&lt;<span class="hljs-title">VesselTrack</span>&gt;</span>
        <span class="hljs-tag">&lt;<span class="hljs-title">VesselTrack</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">id</span>&gt;</span>2677<span class="hljs-tag">&lt;/<span class="hljs-title">id</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">vessel_id</span>&gt;</span>3<span class="hljs-tag">&lt;/<span class="hljs-title">vessel_id</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">status</span>&gt;</span>0<span class="hljs-tag">&lt;/<span class="hljs-title">status</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">speed</span>&gt;</span>144<span class="hljs-tag">&lt;/<span class="hljs-title">speed</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">lon</span>&gt;</span>15.96756<span class="hljs-tag">&lt;/<span class="hljs-title">lon</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">lat</span>&gt;</span>36.25863<span class="hljs-tag">&lt;/<span class="hljs-title">lat</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">course</span>&gt;</span>92<span class="hljs-tag">&lt;/<span class="hljs-title">course</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">heading</span>&gt;</span>93<span class="hljs-tag">&lt;/<span class="hljs-title">heading</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">rot</span>&gt;</span>NULL<span class="hljs-tag">&lt;/<span class="hljs-title">rot</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">timestamp</span>&gt;</span>2017-02-18 20:03:21<span class="hljs-tag">&lt;/<span class="hljs-title">timestamp</span>&gt;</span>
            <span class="hljs-tag">&lt;<span class="hljs-title">vessel</span>&gt;</span>
                <span class="hljs-tag">&lt;<span class="hljs-title">id</span>&gt;</span>3<span class="hljs-tag">&lt;/<span class="hljs-title">id</span>&gt;</span>
                <span class="hljs-tag">&lt;<span class="hljs-title">mmsi</span>&gt;</span>311486000<span class="hljs-tag">&lt;/<span class="hljs-title">mmsi</span>&gt;</span>
            <span class="hljs-tag">&lt;/<span class="hljs-title">vessel</span>&gt;</span>
        <span class="hljs-tag">&lt;/<span class="hljs-title">VesselTrack</span>&gt;</span>
        <span class="hljs-tag">&lt;<span class="hljs-title">with</span>/&gt;</span>
        <span class="hljs-tag">&lt;<span class="hljs-title">additional</span>/&gt;</span>
    <span class="hljs-tag">&lt;/<span class="hljs-title">VesselTrack</span>&gt;</span>
<span class="hljs-tag">&lt;/<span class="hljs-title">root</span>&gt;</span></code></pre><div style="height: 1px;"></div></div></div></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/csv</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code><span class="hljs-string">"vessel"</span>;<span class="hljs-string">"status"</span>;<span class="hljs-string">"speed"</span>;<span class="hljs-string">"lon"</span>;<span class="hljs-string">"lat"</span>;<span class="hljs-string">"course"</span>;<span class="hljs-string">"heading"</span>;<span class="hljs-string">"rot"</span>
<span class="hljs-string">"311486000"</span>;<span class="hljs-string">"0"</span>;<span class="hljs-string">"144"</span>;<span class="hljs-string">"15.96756"</span>;<span class="hljs-string">"36.25863"</span>;<span class="hljs-string">"92"</span>;<span class="hljs-string">"93"</span>;<span class="hljs-string">"NULL"</span></code></pre><div style="height: 1px;"></div></div></div></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
    "<span class="hljs-attribute">errors</span>": <span class="hljs-value">[
        <span class="hljs-string">"vessels.1"</span>: [
            <span class="hljs-string">"The vessels.1 must be an integer."</span>
        ],
        <span class="hljs-string">"location.lat.from"</span>: [
            <span class="hljs-string">"The location.lat.from must be a number."</span>
        ],
        <span class="hljs-string">"location.lon.to"</span>: [
            <span class="hljs-string">"The location.lon.to field is required when location.lat.from / location.lat.to / location.lon.from is present."</span>
        ]
    ]
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
    "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">error</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span>
        </span>}
    </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
    "<span class="hljs-attribute">errors</span>": <span class="hljs-value">[
        <span class="hljs-string">"Request per hour limit reached"</span>: [
            <span class="hljs-string">"Limit is 10 Requests per hour"</span>
        ]
    ]
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
    "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">error</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span>
        </span>}
    </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div></div></div></div></div><div class="middle"><div id="searches-seach-request-post" class="action post"><h4 class="action-heading"><div class="name">Seach Request</div><a href="#searches-seach-request-post" class="method post">POST</a><code class="uri">/search</code></h4><p>Search Request for Vessel Tracks.<br>
Filterable by <strong>Vessels</strong>, <strong>Latitude - Lontitude range</strong> and <strong>Time range</strong>.<br>
Response type option with <strong>response_format</strong>, available formats <strong>json, xml, csv</strong>.</p>
<h4 id="header-request-body-validations-and-requirements">Request Body validations and requirements <a class="permalink" href="#header-request-body-validations-and-requirements" aria-hidden="true">¶</a></h4>
<ol>
<li>
<p>Vesssels (optional) - Array of <code>Integers</code></p>
</li>
<li>
<p>Location (optional) - Object</p>
<ol>
<li>lat - Object
<ol>
<li>from (optional but required if any of <strong><a href="http://locations.lat.to">locations.lat.to</a> or locations.lon.from or <a href="http://locations.to">locations.to</a></strong> is present) - <code>Decimal</code> range: -180, 180</li>
<li>to (optional but required if any of <strong>locations.lat.from or locations.lon.from or <a href="http://locations.to">locations.to</a></strong> is present) - <code>Decimal</code> range: -180, 180</li>
</ol>
</li>
<li>lon - Object
<ol>
<li>from (optional but required if any of <strong>locations.lat.from or <a href="http://locations.lat.to">locations.lat.to</a> or <a href="http://locations.to">locations.to</a></strong> is present) - <code>Decimal</code> range: -180, 180</li>
<li>to (optional but required if any of <strong>locations.lat.from or <a href="http://locations.lat.to">locations.lat.to</a> or locations.from</strong> is present) - <code>Decimal</code> range: -180, 180</li>
</ol>
</li>
</ol>
</li>
<li>
<p>Time (optional) - Object</p>
<ol>
<li>from (optional but required if <strong><a href="http://time.to">time.to</a></strong> is present) - <code>String [Timestamp formatl]</code></li>
<li>to (optional but required if <strong>time.from</strong> is present) - <code>String [Timestamp formatl]</code></li>
</ol>
</li>
</ol>
</div></div><hr class="split"><div class="middle"><section id="vessel-tracks" class="resource-group"><h2 class="group-heading">Vessel Tracks <a href="#vessel-tracks" class="permalink">&para;</a></h2></section></div><div class="middle"><div id="vessel-tracks-vessels-tracks-collection" class="resource"><h3 class="resource-heading">Vessels Tracks Collection <a href="#vessel-tracks-vessels-tracks-collection" class="permalink">&para;</a></h3></div></div><div class="right"><div class="definition"><span class="method get">GET</span>&nbsp;<span class="uri"><span class="hostname">https://www.manoloudis.gr/marine/api</span>/tracks</span></div><div class="tabs"><div class="tabs"><div class="example-names"><span>Responses</span><span class="tab-button">200</span></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">[
    {
      "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
      "<span class="hljs-attribute">status</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
      "<span class="hljs-attribute">speed</span>": <span class="hljs-value"><span class="hljs-number">180</span></span>,
      "<span class="hljs-attribute">lon</span>": <span class="hljs-value"><span class="hljs-number">15.4415</span></span>,
      "<span class="hljs-attribute">lat</span>": <span class="hljs-value"><span class="hljs-number">42.75178</span></span>,
      "<span class="hljs-attribute">course</span>": <span class="hljs-value"><span class="hljs-number">144</span></span>,
      "<span class="hljs-attribute">heading</span>": <span class="hljs-value"><span class="hljs-number">144</span></span>,
      "<span class="hljs-attribute">rot</span>": <span class="hljs-value"><span class="hljs-string">"NULL"</span></span>,
      "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-18 05:18:39"</span></span>,
      "<span class="hljs-attribute">vessel</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
        "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value"><span class="hljs-number">247039300</span>
      </span>}
    </span>}
  ]
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
    "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"array"</span></span>,
            "<span class="hljs-attribute">items</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
                "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">status</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">speed</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">lon</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                    "<span class="hljs-attribute">lat</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                    "<span class="hljs-attribute">course</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">heading</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    "<span class="hljs-attribute">rot</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span></span>}</span>,
                    "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span></span>}</span>,
                    "<span class="hljs-attribute">vessel</span>": <span class="hljs-value">{
                        "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
                        "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
                            "<span class="hljs-attribute">id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                            "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                        }
                    </span>}
                </span>}
            </span>}
        </span>}
    </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div></div></div></div><div class="middle"><div id="vessel-tracks-vessels-tracks-collection-get" class="action get"><h4 class="action-heading"><div class="name">Vessels Tracks Collection</div><a href="#vessel-tracks-vessels-tracks-collection-get" class="method get">GET</a><code class="uri">/tracks</code></h4><p>Displays Collection of All Vessels Tracks.</p>
</div></div><hr class="split"><div class="middle"><div id="vessel-tracks-vessel-track-object" class="resource"><h3 class="resource-heading">Vessel Track Object <a href="#vessel-tracks-vessel-track-object" class="permalink">&para;</a></h3></div></div><div class="right"><div class="definition"><span class="method get">GET</span>&nbsp;<span class="uri"><span class="hostname">https://www.manoloudis.gr/marine/api</span>/tracks/<span class="hljs-attribute" title="id">1</span></span></div><div class="tabs"><div class="tabs"><div class="example-names"><span>Responses</span><span class="tab-button">200</span><span class="tab-button">404</span></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
    "<span class="hljs-attribute">status</span>": <span class="hljs-value"><span class="hljs-number">0</span></span>,
    "<span class="hljs-attribute">speed</span>": <span class="hljs-value"><span class="hljs-number">180</span></span>,
    "<span class="hljs-attribute">lon</span>": <span class="hljs-value"><span class="hljs-number">15.4415</span></span>,
    "<span class="hljs-attribute">lat</span>": <span class="hljs-value"><span class="hljs-number">42.75178</span></span>,
    "<span class="hljs-attribute">course</span>": <span class="hljs-value"><span class="hljs-number">144</span></span>,
    "<span class="hljs-attribute">heading</span>": <span class="hljs-value"><span class="hljs-number">144</span></span>,
    "<span class="hljs-attribute">rot</span>": <span class="hljs-value"><span class="hljs-string">"NULL"</span></span>,
    "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value"><span class="hljs-string">"2017-02-18 05:18:39"</span></span>,
    "<span class="hljs-attribute">vessel</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">id</span>": <span class="hljs-value"><span class="hljs-number">1</span></span>,
      "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value"><span class="hljs-number">247039300</span>
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
    "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
        "<span class="hljs-attribute">data</span>": <span class="hljs-value">{
            "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
            "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
                "<span class="hljs-attribute">id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">status</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">speed</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">lon</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                "<span class="hljs-attribute">lat</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"decimal"</span></span>}</span>,
                "<span class="hljs-attribute">course</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">heading</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                "<span class="hljs-attribute">rot</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span></span>}</span>,
                "<span class="hljs-attribute">timestamp</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"timestamp"</span></span>}</span>,
                "<span class="hljs-attribute">vessel</span>": <span class="hljs-value">{
                    "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
                    "<span class="hljs-attribute">properies</span>": <span class="hljs-value">{
                        "<span class="hljs-attribute">id</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                        "<span class="hljs-attribute">mmsi</span>": <span class="hljs-value">{"<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"integer"</span></span>}</span>,
                    }
                </span>}
            </span>}
        </span>}
    </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div><div class="tab"><div><div class="inner"><h5>Headers</h5><pre><code><span class="hljs-attribute">Content-Type</span>: <span class="hljs-string">application/json</span></code></pre><div style="height: 1px;"></div><h5>Body</h5><pre><code>{
  "<span class="hljs-attribute">error</span>": <span class="hljs-value"><span class="hljs-string">"Not Found."</span>
</span>}</code></pre><div style="height: 1px;"></div><h5>Schema</h5><pre><code>{
  "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"object"</span></span>,
  "<span class="hljs-attribute">properties</span>": <span class="hljs-value">{
    "<span class="hljs-attribute">error</span>": <span class="hljs-value">{
      "<span class="hljs-attribute">type</span>": <span class="hljs-value"><span class="hljs-string">"string"</span>
    </span>}
  </span>}
</span>}</code></pre><div style="height: 1px;"></div></div></div></div></div></div></div><div class="middle"><div id="vessel-tracks-vessel-track-object-get" class="action get"><h4 class="action-heading"><div class="name">Vessel Track Object</div><a href="#vessel-tracks-vessel-track-object-get" class="method get">GET</a><code class="uri">/tracks/{id}</code></h4><p>Displays Sinlge Client Object</p>
<div class="title"><strong>URI Parameters</strong><div class="collapse-button show"><span class="close">Hide</span><span class="open">Show</span></div></div><div class="collapse-content"><dl class="inner"><dt>id</dt><dd><code>string</code>&nbsp;<span class="required">(required)</span>&nbsp;<span class="text-muted example"><strong>Example:&nbsp;</strong><span>1</span></span><p>The Client ID</p>
</dd></dl></div></div></div><hr class="split"><div class="middle"><p style="text-align: center;" class="text-muted">Generated by&nbsp;<a href="https://github.com/danielgtaylor/aglio" class="aglio">aglio</a>&nbsp;on 01 Nov 2017</p></div></div></div></div><script>/* eslint-env browser */
/* eslint quotes: [2, "single"] */
'use strict';

/*
  Determine if a string ends with another string.
*/
function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

/*
  Get a list of direct child elements by class name.
*/
function childrenByClass(element, name) {
  var filtered = [];

  for (var i = 0; i < element.children.length; i++) {
    var child = element.children[i];
    var classNames = child.className.split(' ');
    if (classNames.indexOf(name) !== -1) {
      filtered.push(child);
    }
  }

  return filtered;
}

/*
  Get an array [width, height] of the window.
*/
function getWindowDimensions() {
  var w = window,
      d = document,
      e = d.documentElement,
      g = d.body,
      x = w.innerWidth || e.clientWidth || g.clientWidth,
      y = w.innerHeight || e.clientHeight || g.clientHeight;

  return [x, y];
}

/*
  Collapse or show a request/response example.
*/
function toggleCollapseButton(event) {
    var button = event.target.parentNode;
    var content = button.parentNode.nextSibling;
    var inner = content.children[0];

    if (button.className.indexOf('collapse-button') === -1) {
      // Clicked without hitting the right element?
      return;
    }

    if (content.style.maxHeight && content.style.maxHeight !== '0px') {
        // Currently showing, so let's hide it
        button.className = 'collapse-button';
        content.style.maxHeight = '0px';
    } else {
        // Currently hidden, so let's show it
        button.className = 'collapse-button show';
        content.style.maxHeight = inner.offsetHeight + 12 + 'px';
    }
}

function toggleTabButton(event) {
    var i, index;
    var button = event.target;

    // Get index of the current button.
    var buttons = childrenByClass(button.parentNode, 'tab-button');
    for (i = 0; i < buttons.length; i++) {
        if (buttons[i] === button) {
            index = i;
            button.className = 'tab-button active';
        } else {
            buttons[i].className = 'tab-button';
        }
    }

    // Hide other tabs and show this one.
    var tabs = childrenByClass(button.parentNode.parentNode, 'tab');
    for (i = 0; i < tabs.length; i++) {
        if (i === index) {
            tabs[i].style.display = 'block';
        } else {
            tabs[i].style.display = 'none';
        }
    }
}

/*
  Collapse or show a navigation menu. It will not be hidden unless it
  is currently selected or `force` has been passed.
*/
function toggleCollapseNav(event, force) {
    var heading = event.target.parentNode;
    var content = heading.nextSibling;
    var inner = content.children[0];

    if (heading.className.indexOf('heading') === -1) {
      // Clicked without hitting the right element?
      return;
    }

    if (content.style.maxHeight && content.style.maxHeight !== '0px') {
      // Currently showing, so let's hide it, but only if this nav item
      // is already selected. This prevents newly selected items from
      // collapsing in an annoying fashion.
      if (force || window.location.hash && endsWith(event.target.href, window.location.hash)) {
        content.style.maxHeight = '0px';
      }
    } else {
      // Currently hidden, so let's show it
      content.style.maxHeight = inner.offsetHeight + 12 + 'px';
    }
}

/*
  Refresh the page after a live update from the server. This only
  works in live preview mode (using the `--server` parameter).
*/
function refresh(body) {
    document.querySelector('body').className = 'preload';
    document.body.innerHTML = body;

    // Re-initialize the page
    init();
    autoCollapse();

    document.querySelector('body').className = '';
}

/*
  Determine which navigation items should be auto-collapsed to show as many
  as possible on the screen, based on the current window height. This also
  collapses them.
*/
function autoCollapse() {
  var windowHeight = getWindowDimensions()[1];
  var itemsHeight = 64; /* Account for some padding */
  var itemsArray = Array.prototype.slice.call(
    document.querySelectorAll('nav .resource-group .heading'));

  // Get the total height of the navigation items
  itemsArray.forEach(function (item) {
    itemsHeight += item.parentNode.offsetHeight;
  });

  // Should we auto-collapse any nav items? Try to find the smallest item
  // that can be collapsed to show all items on the screen. If not possible,
  // then collapse the largest item and do it again. First, sort the items
  // by height from smallest to largest.
  var sortedItems = itemsArray.sort(function (a, b) {
    return a.parentNode.offsetHeight - b.parentNode.offsetHeight;
  });

  while (sortedItems.length && itemsHeight > windowHeight) {
    for (var i = 0; i < sortedItems.length; i++) {
      // Will collapsing this item help?
      var itemHeight = sortedItems[i].nextSibling.offsetHeight;
      if ((itemsHeight - itemHeight <= windowHeight) || i === sortedItems.length - 1) {
        // It will, so let's collapse it, remove its content height from
        // our total and then remove it from our list of candidates
        // that can be collapsed.
        itemsHeight -= itemHeight;
        toggleCollapseNav({target: sortedItems[i].children[0]}, true);
        sortedItems.splice(i, 1);
        break;
      }
    }
  }
}

/*
  Initialize the interactive functionality of the page.
*/
function init() {
    var i, j;

    // Make collapse buttons clickable
    var buttons = document.querySelectorAll('.collapse-button');
    for (i = 0; i < buttons.length; i++) {
        buttons[i].onclick = toggleCollapseButton;

        // Show by default? Then toggle now.
        if (buttons[i].className.indexOf('show') !== -1) {
            toggleCollapseButton({target: buttons[i].children[0]});
        }
    }

    var responseCodes = document.querySelectorAll('.example-names');
    for (i = 0; i < responseCodes.length; i++) {
        var tabButtons = childrenByClass(responseCodes[i], 'tab-button');
        for (j = 0; j < tabButtons.length; j++) {
            tabButtons[j].onclick = toggleTabButton;

            // Show by default?
            if (j === 0) {
                toggleTabButton({target: tabButtons[j]});
            }
        }
    }

    // Make nav items clickable to collapse/expand their content.
    var navItems = document.querySelectorAll('nav .resource-group .heading');
    for (i = 0; i < navItems.length; i++) {
        navItems[i].onclick = toggleCollapseNav;

        // Show all by default
        toggleCollapseNav({target: navItems[i].children[0]});
    }
}

// Initial call to set up buttons
init();

window.onload = function () {
    autoCollapse();
    // Remove the `preload` class to enable animations
    document.querySelector('body').className = '';
};
</script></body></html>