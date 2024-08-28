<!DOCTYPE html>
<html>
<head>
    <style>
    /* Basic Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        background: #181818;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 16px;
        color: #222;
    }

    #cv {
    width: calc(90% - 50px); 
    max-width: 800px;
    background: #f3f3f3;
    margin: 30px auto;
    padding-left: 25px; 
    padding-right: 25px;
    }

    .mainDetails, .mainFooter {
        padding: 20px;
        background: #ededed;
        border-bottom: 2px solid #cf8a05;
    }

    #headshot {
        width: 100px;
        float: left;
        margin-right: 20px;
    }

    #headshot img {
        width: 100%;
        height: auto;
        border-radius: 50%;
    }

    #name {
        float: left;
    }

    #contactDetails {
        float: right;
        text-align: right;
    }

    #contactDetails ul {
        list-style: none;
        font-size: 0.9em;
        margin-top: 0;
    }

    #contactDetails ul li {
        margin-bottom: 5px;
    }

    #contactDetails a {
        color: #444;
        text-decoration: none;
    }

    #contactDetails a:hover {
        color: #cf8a05;
    }

    .clear {
        clear: both;
        border-top: 1px solid #dedede;
    }

    section {
        margin-bottom: 20px;
    }

    .sectionTitle {
        font-size: 1.2em;
        color: #cf8a05;
        margin-bottom: 10px;
    }

    .title {
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .sectionContent {
        margin-left: 0;
    }

    .keySkills {
        list-style: none;
        margin-bottom: 20px;
        color: #444;
    }

    .keySkills li {
        margin-bottom: 5px;
    }

    @media (max-width: 800px) {
        #name, #contactDetails {
            float: none;
            width: 100%;
            text-align: center;
        }

        .sectionTitle, .sectionContent {
            float: none;
            width: 100%;
        }

        .keySkills {
            column-count: 2;
        }
    }

    @media (max-width: 480px) {
        #cv {
            width: calc(95% - 20px); 
            margin: 10px auto;
        }

        .mainDetails, .mainFooter {
            padding: 15px;
        }

        .keySkills {
            column-count: 1;
        }
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
            <section class="summary-section">
                    <div class="title">Professional Summary :-</div>
                    <div class="sectionTitle">
                        <p>Objective</p>
                    </div>
                    <div class="sectionContent">
                        <article>
                            <p>{{ $user->employee->professional_summary}}</p>
                        </article>
                    </div>
            </section>
		
		<section class="summary-section">
			<div class="sectionTitle">
				<p>Work Experience</p>
			</div>
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->work_experience }}</p>
				</article>
			</div>
		</section>	
		
		<section class="summary-section">
			<div class="sectionTitle">
				<p>Current Working Skill</p>
			</div>
			
			<div class="sectionContent">
				<ul class="keySkills">
					<li>{{ $user->employee->current_working_skill }}</li>
				</ul>
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section class="summary-section">
            <div class="title">Qualification :-</div>
			<div class="sectionTitle">
				<p>Heighest Qualification</p>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->qualification }}</p>
				</article>
			</div>
		</section>

        <section class="summary-section">
			<div class="sectionTitle">
				<p>Degree</p>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->Degree }}</p>
				</article>
			</div>
		</section>

        <section class="summary-section">
			<div class="sectionTitle">
				<p>University or college name</p>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->university_or_collegeName }}</p>
				</article>
			</div>
		</section>

        <section class="summary-section">
			<div class="sectionTitle">
				<p>Graduation Date</p>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->graduation_date }}</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>

        <section class="summary-section">
            <div class="title">Work Experience :-</div>
			<div class="sectionTitle">
				<p>Company Name</p>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->company_name }}</p>
				</article>
			</div>
		</section>

        <section class="summary-section">
			<div class="sectionTitle">
				<p>Date of Employment</p>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->dates_of_employment }}</p>
				</article>
			</div>
		</section>

        <section class="summary-section">
            <div class="sectionTitle">
                <p>Working From</p>
            </div>
            
            <div class="sectionContent">
                <article>
                    <p>{{ $user->employee->working_from }}</p>
                </article>
            </div>
        </section>

        <section class="summary-section">
            <div class="sectionTitle">
                <p>Location</p>
            </div>
            
            <div class="sectionContent">
                <article>
                    <p>{{ $user->employee->location }}</p>
                </article>
            </div>
        </section>

        <section class="summary-section">
            <div class="sectionTitle">
                <p>Responsibilities and Achievements</p>
            </div>
            
            <div class="sectionContent">
                <article>
                    <p>{{ $user->employee->responsibilities_and_achievements }}</p>
                </article>
            </div>
            <div class="clear"></div>
        </section>

        <section class="summary-section">
            <div class="title">Projects :-</div>
            @foreach ($user->projects as $project )
            <div >
                <div >
                    <div class="sectionTitle">
                        <p>Project Name</p>
                    </div>
                    <div class="sectionContent">
                        <article>
                            <p>{{ $project->project_name }}</p>
                        </article>
                    </div>
                </div>

                <div >
                    <div class="sectionTitle">
                        <p>Brief Description</p>
                    </div>
                    <div class="sectionContent">
                        <article>
                            <p>{{ $project->brief_description }}</p>
                        </article>
                    </div>
                </div>

                <div >
                    <div class="sectionTitle">
                        <p>Roles and Contribution</p>
                    </div>
                    <div class="sectionContent">
                        <article>
                            <p>{{ $project->role_and_contributions }}</p>
                        </article>
                    </div>
                </div>

                <div >
                    <div class="sectionTitle">
                        <p>Technologies Used</p>
                    </div>
                    <div class="sectionContent">
                        <article>
                            <p>{{ $project->Technologies_used }}</p>
                        </article>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            @endforeach
        </section>


        <section class="summary-section">
            <div class="title">Certificates :-</div>
            @foreach ($user->certificates as $certificates)
            <div class="project-container">
                <div >
                    <div class="sectionTitle">
                        <p>Certficate Name</p>
                    </div>
                    <div class="sectionContent">
                        <article>
                            <p>{{ $certificates->certificate_name }}</p>
                        </article>
                    </div>
                </div>

                <div >
                    <div class="sectionTitle">
                        <p>Date of Certification </p>
                    </div>
                    <div class="sectionContent">
                        <article>
                            <p>{{ $certificates->date_of_certification }}</p>
                        </article>
                    </div>
                </div>

                <div >
                    <div class="sectionTitle">
                        <p>Issuing Organization</p>
                    </div>
                    <div class="sectionContent">
                        <article>
                            <p>{{ $certificates->issuing_organization }}</p>
                        </article>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            @endforeach
        </section>

        <section class="summary-section">
			<div class="sectionTitle">
				<p>Certifications</p>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{ $user->employee->certifications }}</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>

        <section class="summary-section">
            <div class="title">Languages :-</div>
			<div class="sectionTitle">
				<p>languages</p>
			</div>
			
			<div class="sectionContent">
            <ul class="keySkills">
                    @foreach(explode(',', $user->employee->languages) as $languages)
                            <li>{{ trim($languages) }}</li>
                    @endforeach
			</ul>
			</div>
			<div class="clear"></div>
		</section>

		<section class="summary-section">
			<div class="title">Personal Details :-</div>
			
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
                    <p class="sectionTitle">Marital Status:  </p><p class="sectionContent">{{ $user->employee->marriage_status }}</p>
				</article>
			</div>
			<div class="clear mainFooter "></div>
		</section>        
		
	</div>
</div>
</body>
</html>
