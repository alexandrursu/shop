function fwslider(){
    var glob = {
        cs : 0,
        pause: 6000,
        duration: 750,
		mID: 1
    }
    
    this.init = function(params){
        
        if (params.duration) {
            glob.duration = parseInt(params.duration,10);
        }
        
        if (params.pause) {
            glob.pause = parseInt(params.pause,10);
        }
		 if (params.mID) {
            glob.mID = parseInt(params.mID,10);
        }
        
        /* Init */
        content.init();
        display.bindControls();
        controls.bindControls();
		
    }
    
    var display = {
        /* Resize function */
        resize: function(){
			
            $jppc("#fwslider" + glob.mID).css({height: $jppc("#fwslider" + glob.mID + " .slide").height()});
            controls.position();
        },
        
        /* Bind resize listener */
        bindControls: function(){
            $jppc(window).resize(function(){
                display.resize()
            });
        }
    }
    
    var controls = {
        /* Adjust buttons position */
		
        position: function(){
            $jppc("#fwslider" + glob.mID + " .slidePrev, #fwslider" + glob.mID + " .slideNext").css({
                top: $jppc("#fwslider" + glob.mID + "").height() / 2 - $jppc("#fwslider" + glob.mID + " .slideNext").height() / 2
            });
            
            $jppc("#fwslider" + glob.mID + " .slidePrev").css({left:0});
            $jppc("#fwslider" + glob.mID + " .slideNext").css({right:0});
			
        },
        
        /* Bind button controls */
        bindControls : function(){
            
            /* Hover effect */
            $jppc("#fwslider" + glob.mID + " .slidePrev, #fwslider" + glob.mID + " .slideNext").on("mouseover", function(){
                $jppc(this).animate({
                    opacity:1
                },{
                    queue:false, 
                    duration:1000,
                    easing:"easeOutCubic"
                });
            });
            
            /* Hover effect - mouseout */
            $jppc("#fwslider" + glob.mID + " .slidePrev, #fwslider" + glob.mID + " .slideNext").on("mouseout", function(){
                $jppc(this).animate({
                    opacity:0.5
                },{
                    queue:false, 
                    duration:1000,
                    easing:"easeOutCubic"
                });
            });
            
            /* Next Button */
            $jppc("#fwslider" + glob.mID + " .slideNext").on("click", function(){
                if ($jppc("#fwslider" + glob.mID + " .slide").is(":animated")) return; 
                
                if ($jppc("#fwslider" + glob.mID + " .slide:eq("+(glob.cs+1)+")").length <= 0) {
                    glob.cs = 0;
                    
                    $jppc("#fwslider" + glob.mID + " .timers .timer .progress").stop();
                    
                    $jppc("#fwslider" + glob.mID + " .timers .timer:last .progress").animate({
                        width:"100%"
                    },{
                        queue:false,
                        duration:glob.duration,
                        easing:"easeOutCubic",
                        complete: function(){
                            $jppc("#fwslider" + glob.mID + " .timers .timer .progress").css({
                                width:"0%"
                            });
                        }
                    });
                } else {
                    glob.cs++;
                    
                    $jppc("#fwslider" + glob.mID + " .timers .timer .progress").stop();
                    $jppc("#fwslider" + glob.mID + " .timers .timer:lt("+glob.cs+") .progress").animate({
                        width:"100%"
                    },{
                        queue:false,
                        duration:glob.duration,
                        easing:"easeOutCubic"
                    });
                    
                }
                content.show();
            });
            
            /* Previous Button */
            $jppc("#fwslider" + glob.mID + " .slidePrev").on("click", function(){
                if ($jppc("#fwslider" + glob.mID + " .slide").is(":animated")) return; 
                
                if (glob.cs <= 0) {
                    glob.cs = $jppc("#fwslider" + glob.mID + " .slide").index();
                    
                    $jppc("#fwslider" + glob.mID + " .timers .timer .progress").stop();
                    $jppc("#fwslider" + glob.mID + " .timers .timer .progress").css({
                        width:"100%"
                    });
                     $jppc("#fwslider" + glob.mID + " .timers .timer:last .progress").animate({
                        width:"0%"
                    },{
                        queue:false,
                        duration:glob.duration,
                        easing:"easeOutCubic"
                    });
                    
                } else {
                    glob.cs--;
                    
                    $jppc("#fwslider" + glob.mID + " .timers .timer .progress").stop();
                    $jppc("#fwslider" + glob.mID + " .timers .timer:gt("+glob.cs+") .progress").css({
                        width:"0%"
                    });
                    $jppc("#fwslider" + glob.mID + " .timers .timer:eq("+glob.cs+") .progress").animate({
                        width:"0%"
                    },{
                        queue:false,
                        duration:glob.duration,
                        easing:"easeOutCubic"
                    });
                }
                content.show();
            });
        }
    }
    
    var content = {
        init: function(){
            /* First run content adjustment */
            
            for (var i = 0; i < $jppc("#fwslider" + glob.mID + " .slide").length; i++){
                $jppc('<div class="timer"><div class="progress"></div></div>').appendTo("#fwslider" + glob.mID + " .timers");
            }
            
            $jppc("#fwslider" + glob.mID + " .timers").css({
                width: ($jppc("#fwslider" + glob.mID + " .timers .timer").length + 1) * 45
            });
            
            $jppc("#fwslider" + glob.mID + " .slide:eq("+glob.cs+")").fadeIn({
                duration:500, 
                easing: "swing"
            });
            
            $jppc("#fwslider" + glob.mID + "").animate({
                height: $jppc("#fwslider" + glob.mID + " .slide:first img").height()
            },{
                queue:false,
                duration:500, 
                easing: "easeInOutExpo", 
                complete: function(){
                    $jppc("#fwslider" + glob.mID + " .slidePrev").animate({
                        left:0
                    },{
                        queue:false,
                        duration:1000, 
                        easing:"easeOutCubic"
                    });
                    
                    $jppc("#fwslider" + glob.mID + " .slideNext").animate({
                        right:0
                    },{
                        queue:false,
                        duration:1000, 
                        easing:"easeOutCubic"
                    });
                    
                    content.showText();
                    controls.position();
                    display.resize();
                    auto.run();
                    auto.focus();
                }
            });
        },
        
        show: function(){
            /* Show slide */
            
            content.hideText();
            
            $jppc("#fwslider" + glob.mID + " .slide:eq("+glob.cs+")").css({
                opacity:0,
                zIndex:2
            }).show().animate({
                opacity:1
            },{
                queue:false,
                duration: glob.duration, 
                easing: "swing", 
                complete: function(){
                    $jppc("#fwslider" + glob.mID + " .slide:lt("+glob.cs+"), #fwslider" + glob.mID + " .slide:gt("+glob.cs+")").css({
                        zIndex:0
                    }).hide();
                   
                    $jppc("#fwslider" + glob.mID + " .slide:eq("+glob.cs+")").css({
                        zIndex:1
                    });
                    content.showText();
                    auto.run();
                }
            });
        },
        
        showText: function(){
            /* Show slide text */
            
             $jppc("#fwslider" + glob.mID + " .slide:eq("+glob.cs+") .title").animate({
                opacity:1
            },{
                queue:false,
                duration:300,
                easing:"swing"
            });
            
            setTimeout(function(){
                $jppc("#fwslider" + glob.mID + " .slide:eq("+glob.cs+") .description").animate({
                    opacity:1
                },{
                    queue:false,
                    duration:300,
                    easing:"swing"
                });
            },150)
            
            setTimeout(function(){
                $jppc("#fwslider" + glob.mID + " .slide:eq("+glob.cs+") .readmore").animate({
                    opacity:1
                },{
                    queue:false,
                    duration:300,
                    easing:"swing"
                });
            },300)
            
            
        },
        hideText: function(){
            /* Hide slide text */
            
            $jppc("#fwslider" + glob.mID + " .slide .title").animate({
                opacity:0
            },{
                queue:false,
                duration:300,
                easing:"swing"
            });
            
            setTimeout(function(){
                $jppc("#fwslider" + glob.mID + " .slide .description").animate({
                    opacity:0
                },{
                    queue:false,
                    duration:300,
                    easing:"swing"
                });
            },150)
            
            setTimeout(function(){
                $jppc("#fwslider" + glob.mID + " .slide .readmore").animate({
                    opacity:0
                },{
                    queue:false,
                    duration:300,
                    easing:"swing"
                });
            },300)
            
            
        }
    }
    
    var auto = {
        /* Run timer */
        run: function(){
            $jppc("#fwslider" + glob.mID + " .timer:eq("+glob.cs+") .progress").animate({
                width:"100%" 
            },{
                queue:false,
                duration: (glob.pause - (glob.pause/100)*((($jppc("#fwslider" + glob.mID + " .timer:eq("+glob.cs+") .progress").width() / $jppc("#fwslider" + glob.mID + " .timer:eq("+glob.cs+")").width()) * 100))), 
                easing:"linear", 
                complete: function(){
                    $jppc("#fwslider" + glob.mID + " .slideNext").trigger("click");
                }
            });
        },
        
        /* Stop on focus */
        focus: function(){
            $jppc("#fwslider" + glob.mID + " .slide_content").on("mouseover", function(){
                if ($jppc("#fwslider" + glob.mID + " .slide").is(":animated")) return;
                $jppc("#fwslider" + glob.mID + " .timer .progress").stop();
            });
            
            $jppc("#fwslider" + glob.mID + " .slide_content").on("mouseleave", function(){
                if ($jppc("#fwslider" + glob.mID + " .slide").is(":animated")) return;
                auto.run();
            });
        }
    }
}