<div class="portfolio-top"></div>

            {{-- Portfolio filters --}}
            <div class="element-line">
                <div id="filters" class="mybutton small">
                    <a href="#" data-filter="*"><span data-hover="Show all">显示所有</span></a>
                    <a href="#" data-filter=".branding"><span data-hover="Branding">闲置转让</span></a>
                    <a href="#" data-filter=".design"><span data-hover="Design">收购二手</span></a>
                    <a href="#" data-filter=".photography"><span data-hover="Photography">换购体验场</span></a>
                    <!-- <a href="#" data-filter=".videography"><span data-hover="Videography">Videography</span></a>
                    <a href="#" data-filter=".web"><span data-hover="Web">Web</span></a> -->
                </div>
            </div>
            {{-- Portfolio filters --}}

            <div id="portfolio-wrap">

                {{-- portfolio item --}}
                <div class="portfolio-item photography web">
                    <div class="portfolio">
                        <a href="#" class="zoom">
                            {{ HTML::image('images/portfolio1.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-bars fa-4x"></i> <em class="lead">Ducati Monster 620 Racer</em> <em>Photo slider</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                {{-- portfolio item --}}
                <div class="portfolio-item branding photography">
                    <div class="portfolio">
                        <a href="#" class="zoom">
                            {{ HTML::image('images/portfolio2.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-youtube-play fa-4x"></i> <em class="lead">Hexter Photoshoot</em> <em>Video Project</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                {{-- portfolio item --}}
                <div class="portfolio-item branding web">
                    <div class="portfolio">
                        <a href="#" class="zoom">
                            {{ HTML::image('images/portfolio3.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-plus fa-4x"></i> <em class="lead">Creative Laba</em> <em>Project Details</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                <!-- portfolio item -->
                <div class="portfolio-item branding videography web">
                    <div class="portfolio">
                        <a href="#" class="zoom">
                            {{ HTML::image('images/portfolio12.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-bars fa-4x"></i> <em class="lead">New Designers Show 2011</em> <em>Photo slider</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                {{-- portfolio item --}}
                <div class="portfolio-item branding photography">
                    <div class="portfolio">
                        <a href="#" class="zoom">
                            {{ HTML::image('images/portfolio5.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-youtube-play fa-4x"></i> <em class="lead">Designing Green trophy</em> <em>Video Project</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                <!-- portfolio item -->
                <div class="portfolio-item design web">
                    <div class="portfolio">
                        <a href="#" class="zoom">
                            {{ HTML::image('images/portfolio6.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-plus fa-4x"></i> <em class="lead">Starbucks Cups</em> <em>Project Details</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                {{-- portfolio item --}}
                <div class="portfolio-item branding photography videography">
                    <div class="portfolio">
                        <a href="#" class="zoom">
                            {{ HTML::image('images/portfolio7.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-bars fa-4x"></i> <em class="lead">Mercedes CLS Design</em> <em>Photo slider</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                {{-- portfolio item --}}
                <div class="portfolio-item branding design web">
                    <div class="portfolio">
                        <a href="#" class="zoom">   {{ HTML::image('images/portfolio4.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-youtube-play fa-4x"></i> <em class="lead">DISK & COVER</em> <em>Music Mockup</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                {{-- portfolio item --}}
                <div class="portfolio-item branding photography">
                    <div class="portfolio">
                        <a href="#" class="zoom">{{ HTML::image('images/portfolio9.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-plus fa-4x"></i> <em class="lead">Creative Mornings</em> <em>Project Details</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                {{-- portfolio item --}}
                <div class="portfolio-item design web">
                    <div class="portfolio">
                        <a href="#" class="zoom">
                            {{ HTML::image('images/portfolio10.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-bars fa-4x"></i> <em class="lead">iPod Headphones</em> <em>Photo slider</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                {{-- portfolio item --}}
                <div class="portfolio-item web">
                    <div class="portfolio">
                        <a href="#!portfolio/project-2.html" class="zoom">  {{ HTML::image('images/portfolio11.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-youtube-play fa-4x"></i> <em class="lead">Simpli Nota</em> <em>Dark Identity</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

                {{-- portfolio item --}}
                <div class="portfolio-item design videography web">
                    <div class="portfolio">
                        <a href="#!portfolio/project-3.html" class="zoom">
                            {{ HTML::image('images/portfolio8.jpg') }}
                        <div class="hover-items">
                            <span> <i class="fa fa-plus fa-4x"></i> <em class="lead">Yankees Logo</em> <em>Project Details</em> </span>
                        </div> </a>
                    </div>
                </div>
                {{-- portfolio item --}}

            </div>

            {{-- Ajax Portfolio content --}}
            <div id="ajax-section">
                <div class="container clearfix">
                    <div id="project-navigation" class="text-center">
                        <ul>
                            <li id="prevProject">
                                <a href="#"><i class="fa fa-chevron-circle-left fa-2x"></i></a>
                            </li>
                            <li id="closeProject">
                                <a href="#loader"><i class="fa fa-times-circle fa-2x"></i></a>
                            </li>
                            <li id="nextProject">
                                <a href="#"><i class="fa fa-chevron-circle-right fa-2x"></i></a>
                            </li>
                        </ul>
                    </div>

                    {{-- Ajax loader --}}
                    <div id="loader"></div>
                    {{-- Ajax loader --}}

                    <div id="ajax-content-outer">
                        <div id="ajax-content-inner"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                        <div class="element-line">
                            <div class="pager">
                                <div class="puls previous">
                                    <a href="blog-details.html#">&larr; Older</a>
                                </div>

                                <ul class="pagination">

                                    <li class="active">
                                        <a href="#">1</a>
                                    </li>
                                    <li>
                                        <a href="#">2</a>
                                    </li>
                                    <li>
                                        <a href="#">3</a>
                                    </li>
                                </ul>

                                <div class="puls next">
                                    <a href="blog-details.html#">Newer &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>


            <div class="clear"></div>
            {{-- Ajax content --}}