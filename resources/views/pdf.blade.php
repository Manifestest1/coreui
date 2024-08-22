<!DOCTYPE html>
<html>
<head>
	<style>
		html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video {
    border:0;
    font:inherit;
    font-size:100%;
    margin:0;
    padding:0;
    vertical-align:baseline;
    }

    article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section {
    display:block;
    }

    html, body {background: #181818; font-family:  helvetica, arial, sans-serif; font-size: 16px; color: #222;}

    .clear {
        clear: both;
        border-top: 1px solid #dedede;
    }

    p {
        font-size: .9em;
        line-height: 1.4em;
        margin-bottom: 20px;
        color: #444;
    }

    #cv {
        width: 90%;
        max-width: 800px;
        background: #f3f3f3;
        margin: 30px auto;
    }

    .mainDetails {
        
        padding: 25px 35px;
        border-bottom: 2px solid #cf8a05;
        background: #ededed;
    }

    .mainFooter {
        border-top: 2px solid #cf8a05;
        padding: 25px 35px;
    }

    #name h1 {
        font-size: 2.5em;
        font-weight: 700;
        font-family:  Helvetica, Arial, sans-serif;
        margin-bottom: -6px;
    }

    #name h2 {
        font-size: 2em;
        margin-left: 2px;
        font-family: Helvetica, Arial, sans-serif;
    }

    #mainArea {
        padding: 0 40px;
    }

    #headshot {
        width: 12.5%;
        float: left;
        margin-right: 30px;
    }

    #headshot img {
        width: 100px;
        height: 100px;
        -webkit-border-radius: 50px;
        border-radius: 50px;
    }

    #name {
        float: left;
    }

    #contactDetails {
        float: right;
    }

    #contactDetails ul {
        list-style-type: none;
        font-size: 0.9em;
        margin-top: 2px;
    }

    #contactDetails ul li {
        margin-bottom: 3px;
        color: #444;
    }

    #contactDetails ul li a, a[href^=tel] {
        color: #444; 
        text-decoration: none;
        -webkit-transition: all .3s ease-in;
        -moz-transition: all .3s ease-in;
        -o-transition: all .3s ease-in;
        -ms-transition: all .3s ease-in;
        transition: all .3s ease-in;
    }

    #contactDetails ul li a:hover { 
        color: #cf8a05;
    }

    section:first-child {
        border-top: 0;
    }

    section:last-child {
        padding: 20px 0 10px;
    }

    .sectionTitle {
        float: left;
        width: 25%;
    }

    .sectionContent {
        float: right;
        width: 72.5%;
    }

    .sectionTitle h1 {
        font-family:  Helvetica, Arial, sans-serif;
        font-style: Arial;
        font-size: .9em;
        color: #cf8a05;
        margin-bottom: 23px;
    }

    p.sectionTitle{
        color: #cf8a05;
    }

    .sectionContent h2 {
        font-size: 0.9em;
    }

    .subDetails {
        font-size: 0.8em;
        font-style: Arial;
        margin-bottom: 3px;
    }

    .keySkills {
        list-style-type: none;
        -moz-column-count:3;
        -webkit-column-count:3;
        column-count:3;
        margin-bottom: 20px;
        font-size: .9em;
        color: #444;
        list-style-position: inside;
    }

    .marginFooter{
        margin-bottom: 20px;
    }

    li::marker {
    color: #cf8a05; 
    }

    li {
        list-style-type: disc;
        font-size: .9em;
        list-style-position: inside;
     }

    .keySkills ul li {
        margin-bottom: 3px;
    }

    @media all and (min-width: 602px) and (max-width: 800px) 
    {
      
        
        .keySkills {
        -moz-column-count:2;
        -webkit-column-count:2;
        column-count:2;
        }
    }

    @media all and (max-width: 601px) {
        #cv {
            width: 95%;
            margin: 10px auto;
            min-width: 280px;
        }
        
      
        
        #name, #contactDetails {
            float: none;
            width: 100%;
            text-align: center;
        }
        
        .sectionTitle, .sectionContent {
            float: none;
            width: 100%;
        }
        
        .sectionTitle {
            margin-left: -2px;
            font-size: 1.25em;
        }
        
        .keySkills {
            -moz-column-count:2;
            -webkit-column-count:2;
            column-count:2;
        }
    }

    @media all and (max-width: 480px) {
        .mainDetails {
            padding: 15px 15px;
        }
        
        section {
            padding: 15px 0 0;
        }
        
        #mainArea {
            padding: 0 15px;
        }

        
        .keySkills {
        -moz-column-count:1;
        -webkit-column-count:1;
        column-count:1;
        }
        
        #name h1 {
            line-height: .8em;
            margin-bottom: 3px;
        }
    }
    

    .instaFade {
        -webkit-animation-name: reset, fade-in;
        -webkit-animation-duration: 1.5s;
        -webkit-animation-timing-function: ease-in;
        
        -moz-animation-name: reset, fade-in;
        -moz-animation-duration: 1.5s;
        -moz-animation-timing-function: ease-in;
        
        animation-name: reset, fade-in;
        animation-duration: 1.5s;
        animation-timing-function: ease-in;
    }

    .quickFade {
        -webkit-animation-name: reset, fade-in;
        -webkit-animation-duration: 2.5s;
        -webkit-animation-timing-function: ease-in;
        
        -moz-animation-name: reset, fade-in;
        -moz-animation-duration: 2.5s;
        -moz-animation-timing-function: ease-in;
        
        animation-name: reset, fade-in;
        animation-duration: 2.5s;
        animation-timing-function: ease-in;
    }
    #pdf1{
        margin-top: 10px;
        }
    .title{
        font-family:  Helvetica, Arial, sans-serif;
        font-style: Arial;
        font-size: 1.25em;
        margin-bottom: 20px;
        margin-top: 20px;
        text-align: left;
        font-weight: bold;
        
    }
	</style>
</head>
<body id="top">
<div id="cv" class="instaFade">
        <div class="mainDetails">
            <div id="headshot" class="quickFade">
                <img src="{{ $imageUrl }}" alt="Profile Image" />
            </div>
            <div id="name">
                <h1>{{ $user->name }}</h1>
                <h3 id="pdf1">JR. FULL-STACK DEVELOPER</h3>
            </div>
            <div id="contactDetails" class="quickFade delayFour">
                <ul>
                    <li>{{ $user->employee->permanent_address }}</li>
                    <li>email: <a href="mail:{{ $user->email }}" target="_blank">{{ $user->email }}</a></li>
                    <li>Linkedin Profile: <a href="mail:{{ $user->employee->linkedIn_profile }}" target="_blank">{{ $user->employee->linkedIn_profile}}</a></li>
                    <li>contact: <a href="tel:{{ $user->employee->phone }}" target="_blank">{{ $user->employee->phone }}</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div id="mainArea" class="quickFade delayFive">
            <section>
                    <div class="title">Professional Summary</div>
                    <div class="sectionTitle">
                        <h1>Objective</h1>
                    </div>
                    <div class="sectionContent">
                        <article>
                            <p>{{ $user->employee->professional_summary}}</p>
                        </article>
                    </div>
            </section>
		
		<section>
			<div class="sectionTitle">
				<h1>Work Experience</h1>
			</div>
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->work_experience }}</p>
				</article>
			</div>
		</section>	
		
		<section>
			<div class="sectionTitle">
				<h1>Current Working Skill</h1>
			</div>
			
			<div class="sectionContent">
				<ul class="keySkills">
					<li>{{ $user->employee->current_working_skill }}</li>
				</ul>
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section>
            <div class="title">Qualification</div>
			<div class="sectionTitle">
				<h1>Heighest Qualification</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->qualification }}</p>
				</article>
			</div>
		</section>

        <section>
			<div class="sectionTitle">
				<h1>Degree</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->Degree }}</p>
				</article>
			</div>
		</section>

        <section>
			<div class="sectionTitle">
				<h1>University or college name</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->university_or_collegeName }}</p>
				</article>
			</div>
		</section>

        <section>
			<div class="sectionTitle">
				<h1>Graduation Date</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->graduation_date }}</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>

        <section>
            <div class="title">Work Experience</div>
			<div class="sectionTitle">
				<h1>Company Name</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->company_name }}</p>
				</article>
			</div>
		</section>

        <section>
			<div class="sectionTitle">
				<h1>Date of Employment</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->dates_of_employment }}</p>
				</article>
			</div>
		</section>

        <section>
            <div class="sectionTitle">
                <h1>Working From</h1>
            </div>
            
            <div class="sectionContent">
                <article>
                    <p>{{ $user->employee->working_from }}</p>
                </article>
            </div>
        </section>

        <section>
            <div class="sectionTitle">
                <h1>Location</h1>
            </div>
            
            <div class="sectionContent">
                <article>
                    <p>{{ $user->employee->location }}</p>
                </article>
            </div>
        </section>

        <section>
            <div class="sectionTitle">
                <h1>Responsibilities and Achievements</h1>
            </div>
            
            <div class="sectionContent">
                <article>
                    <p>{{ $user->employee->responsibilities_and_achievements }}</p>
                </article>
            </div>
            <div class="clear"></div>
        </section>

        <section>
        <div class="title">Projects</div>
			<div class="sectionTitle">
				<h1>Project Name</h1>
			</div>

			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->project_title }}</p>
				</article>
			</div>
		</section>

        <section>
            <div class="sectionTitle">
                <h1>Brief Description</h1>
            </div>
            
            <div class="sectionContent">
                <article>
                    <p>{{ $user->employee->brief_description}}</p>
                </article>
            </div>
        </section>

        <section>
			<div class="sectionTitle">
				<h1>Roles and Contribution</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->role_and_contributions }}</p>
				</article>
			</div>
            <div class="clear"></div>
		</section>

        <section>
            <div class="title">Skill</div>
			<div class="sectionTitle">
				<h1>Certification</h1>
			</div>

            <div class="sectionContent">
				<ul class="keySkills">
                    @foreach(explode(',', $user->employee->certifications) as $certification)
                            <li>{{ trim($certification) }}</li>
                            <li>{{ $user->employee->date_of_certification }}</li>
                    @endforeach
				</ul>
			</div>
		</section>

        <section>
			<div class="sectionTitle">
				<h1>Issuing Organization</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->issuing_organization }}</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>

        <section>
            <div class="title">Languages</div>
			<div class="sectionTitle">
				<h1>languages</h1>
			</div>
			
			<div class="sectionContent">
            <ul class="keySkills">
                    @foreach(explode(',', $user->employee->languages) as $languages)
                            <li>{{ trim($languages) }}</li>
                    @endforeach
			</ul>
			</div>
		</section>

        <section>
			<div class="sectionTitle">
				<h1>proficiency Level of Languages</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->proficiency_level_of_language }}</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>

		<section>
			<div class="title">Personal Details</div>
			
			<div class=" marginFooter">
				<article>
					<p class="sectionTitle">Permanent Address :  </p><p>{{ $user->employee->permanent_address }}</p>
                    <p class="sectionTitle">Adhar Card No:  </p><p class="sectionContent">{{ $user->employee->adhar_card_no }}</p>
                    <p class="sectionTitle">Hobbies:  </p><p class="sectionContent">{{ $user->employee->hobbies }}</p>
                    <p class="sectionTitle">City:  </p><p class="sectionContent">{{ $user->employee->city }}</p>
                    <p class="sectionTitle">State:  </p><p class="sectionContent">{{ $user->employee->state }}</p>
                    <p class="sectionTitle">Country:  </p><p class="sectionContent">{{ $user->employee->country }}</p>
                    <p class="sectionTitle">Pin Code:  </p><p class="sectionContent">{{ $user->employee->pincode }}</p>
                    <p class="sectionTitle">Gender:  </p><p class="sectionContent">{{ $user->employee->gender }}</p>
                    <p class="sectionTitle">Marital Status:  </p><p class="sectionContent">{{ $user->employee->marital_status }}</p>
				</article>
			</div>
			<div class="clear mainFooter "></div>
		</section>        
		
	</div>
</div>
</body>
</html>