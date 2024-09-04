<!DOCTYPE html>
<html>
    <head>
        <style>
        /* Basic Reset */

        * {
            margin: 0;
            padding: 3px;
            box-sizing: border-box;
        } 

        html, body {
            background: #181818;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #222;
            font-weight: 400 !important;;
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
        }
        
        .mainDetails {
            border-bottom: 2px solid #cf8a05;
            margin-bottom: 20px;
        }

        .mainFooter {
            border-top: 2px solid #cf8a05;
            margin-top: 10px;
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

        .contact a {
            color: black; 
            text-decoration: none;
        }

        .clear {
            clear: both;
            border-top: 1px solid #dedede;
        }

        .sectionTitle {
            font-size: 1.2em;
            color: #cf8a05;
        }

        .title {
            font-size: 1.5em;
            margin: 15px 0 5px 0;
        }

        .keySkills {
            list-style: none;
            margin: 0;
            padding: 0;
            display: table;
            width: 100%;
            font-weight: 400 !important; 
        }

        .keySkills li {
            display: table-cell;
            width: 25%; 
            text-align: left;
            color: #444;
            padding-right: 15px; 
            font-weight: 400 !important;

        }

        .spanStyle {
            margin-left: 20px;
            color: black;  
        }

        .summary-section {
            margin-bottom: 20px;
        }

        .tdstyle {
            vertical-align: top;
            font-weight: 400; 
        }

        .liststyle {
            padding: 0;
        }

        table,  ul, li, p, h1, h2, h3, h4, h5, h6 {
        font-weight: 400 !important; 
}

        </style>
    </head>
    <body id="top">
        <div class="page">
            <div id="cv">
                    <div class="mainDetails">
                        <div id="headshot">
                            <img src="{{ $imageUrl }}" alt="Profile Image" />
                        </div>
                        <div id="name">
                            <h1>{{ $user->name }}</h1>
                            <h3 id="pdf1">JR. FULL-STACK DEVELOPER</h3>
                            <p class="contact">email: <a href="mail:{{ $user->email }}" target="_blank">{{ $user->email }}</a></p>
                            <p class="contact">mobile: <a href="tel:{{ $user->employee->phone }}" target="_blank">{{ $user->employee->phone }}</a></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                <div >
                        
                    <div class="title">Professional Summary :-</div>
                        <section >
                                <div class="sectionTitle">
                                    <p>Objective: <span class="spanStyle">{{ $user->employee->professional_summary}}</span></p>
                                </div>
                        </section>
                    
                    <section >
                        <div class="sectionTitle">
                            <p>Professional Experience: <span class="spanStyle">{{ $user->employee->work_experience }}</span></p>
                        </div>
                    </section>	
                    
                    <section class="summary-section" style="display:flex;">
                        <div class="sectionTitle">
                            <p>Current Working Skill: <span class="spanStyle">{{ $user->employee->current_working_skill }}</span></p>
                        </div>
                        
                        <div class="clear"></div>
                    </section>
                    
                    <div class="title">Qualification :-</div>
                    <section class="summary-section">
                        <div class="sectionTitle">
                            <p>Heighest Qualification: <span class="spanStyle">{{ $user->employee->qualification }}</span></p>
                        </div>
                    </section>

                    <section class="summary-section">
                        <div class="sectionTitle">
                            <p>Degree: <span class="spanStyle">{{ $user->employee->Degree }}</span></p>
                        </div>
                    </section>

                    <section class="summary-section">
                        <div class="sectionTitle">
                            <p>University or college name: <span class="spanStyle">{{ $user->employee->university_or_collegeName }}</span></p>
                        </div>
                    </section>

                    <section class="summary-section">
                        <div class="sectionTitle">
                            <p>Graduation Date: <span class="spanStyle">{{ $user->employee->graduation_date }}</span></p>
                        </div>
                        <div class="clear margin"></div>
                    </section>

                    <div class="title">Work Experience :-</div>
                    <section class="summary-section">
                        <div class="sectionTitle">
                            <p>Company Name: <span class="spanStyle">{{ $user->employee->company_name }}</span></p>
                        </div>
                    </section>

                    <section class="summary-section">
                        <div class="sectionTitle">
                            <p>Date of Employment: <span class="spanStyle">{{ $user->employee->dates_of_employment }}</span></p>
                        </div>
                    </section>

                    <section class="summary-section">
                        <div class="sectionTitle">
                            <p>Working From: <span class="spanStyle">{{ $user->employee->working_from }}</span></p>
                        </div>
                    </section>

                    <section class="summary-section">
                        <div class="sectionTitle">
                            <p>Location: <span class="spanStyle">{{ $user->employee->location }}</span></p>
                        </div>
                    </section>

                    <section class="summary-section">
                        <div class="sectionTitle">
                            <p>Responsibilities and Achievements: <span class="spanStyle">{{ $user->employee->responsibilities_and_achievements }}</span></p>
                        </div>
                        <div class="clear margin"></div>
                    </section>

                    <div class="title">Projects :-</div>
                    <section class="summary-section">
                        @foreach ($user->projects as $project )
                        <div >
                            <div >
                                <div class="sectionTitle">
                                    <p> Project Name: <span class="spanStyle">{{ $project->project_name }}</span></p>
                                </div>
                            </div>

                            <div >
                                <div class="sectionTitle">
                                    <p>Brief Description: <span class="spanStyle">{{ $project->brief_description }}</span></p>
                                </div>
                            </div>

                            <div >
                                <div class="sectionTitle">
                                    <p>Roles and Contributions: <span class="spanStyle">{{ $project->role_and_contributions }}</span></p>
                                </div>
                            </div>

                            <div >
                                <div class="sectionTitle">
                                    <p>Technologies Used: <span class="spanStyle">{{ $project->Technologies_used }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="clear margin"></div>
                    </section>


                    <div class="title">Certificates :-</div>
                    <section class="summary-section">
                        @foreach ($user->certificates as $certificates)
                        <div class="project-container">
                            <div >
                                <div class="sectionTitle">
                                    <p> Certficate Name: <span class="spanStyle">{{ $certificates->certificate_name }}</span></p>
                                </div>
                            </div>

                            <div >
                                <div class="sectionTitle">
                                    <p>Date of Certification: <span class="spanStyle">{{ $certificates->date_of_certification }}</span></p>
                                </div>
                            </div>

                            <div >
                                <div class="sectionTitle">
                                    <p>Issuing Organization: <span class="spanStyle">{{ $certificates->issuing_organization }}</span></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    <div class="clear margin"></div>
                    </section>

                    <div class="title">Languages :-</div>
                    <section class="summary-section">
                        <table>
                            <tr>
                                <td class="tdstyle">Languages Known:</td>  
                                <td>   
                                    <ul class="keySkills">
                                        @foreach(explode(',', $user->employee->languages) as $languages)
                                            <li class="liststyle">{{ trim($languages) }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                        <div class="clear"></div>
                    </section>


                    <div class="title">Personal Details :-</div>
                    <section class="summary-section">
                        <div class=" marginFooter">
                        <div class="sectionTitle">
                            <p>Permanent Address :  <span class="spanStyle">{{ $user->employee->permanent_address }}</span></p>
                        </div>
                        <div class="sectionTitle">
                            <p>LinkedIn Profile: <span class="spanStyle">{{ $user->employee->linkedIn_profile }}</span></p>
                        </div>
                        <div class="sectionTitle">
                            <p>Adhar Card No:  <span class="spanStyle">{{ $user->employee->adhar_card_no }}</span></p>
                        </div>
                        <div class="sectionTitle">
                            <p>Hobbies:  <span class="spanStyle">{{ $user->employee->hobbies }}</span></p>
                        </div>
                        <div class="sectionTitle">
                            <p>City:  <span class="spanStyle">{{ $user->employee->city }}</span></p>
                        </div>
                        <div class="sectionTitle">
                            <p>State:  <span class="spanStyle">{{ $user->employee->state }}</span></p>
                        </div>
                        <div class="sectionTitle">
                            <p>Country:  <span class="spanStyle">{{ $user->employee->country }}</span></p>
                        </div>
                        <div class="sectionTitle">
                            <p>Pin Code:  <span class="spanStyle">{{ $user->employee->pincode }}</span></p>
                        </div>
                        <div class="sectionTitle">
                            <p>Gender:  <span class="spanStyle">{{ $user->employee->gender }}</span></p>
                        </div>
                        <div class="sectionTitle">
                            <p>Marital Status:  <span class="spanStyle">{{ $user->employee->marriage_status }}</span></p>
                        </div>
                            <!-- <article>
                                <p class="sectionTitle">Permanent Address :  </p><p class="sectionContent">{{ $user->employee->permanent_address }}</p>
                                <p class="sectionTitle">LinkedIn Profile: </p><p class="sectionContent">{{ $user->employee->linkedIn_profile }}</p>
                                <p class="sectionTitle">Adhar Card No:  </p><p class="sectionContent">{{ $user->employee->adhar_card_no }}</p>
                                <p class="sectionTitle">Hobbies:  </p><p class="sectionContent">{{ $user->employee->hobbies }}</p>
                                <p class="sectionTitle">City:  </p><p class="sectionContent">{{ $user->employee->city }}</p>
                                <p class="sectionTitle">State:  </p><p class="sectionContent">{{ $user->employee->state }}</p>
                                <p class="sectionTitle">Country:  </p><p class="sectionContent">{{ $user->employee->country }}</p>
                                <p class="sectionTitle">Pin Code:  </p><p class="sectionContent">{{ $user->employee->pincode }}</p>
                                <p class="sectionTitle">Gender:  </p><p class="sectionContent">{{ $user->employee->gender }}</p>
                                <p class="sectionTitle">Marital Status:  </p><p class="sectionContent">{{ $user->employee->marriage_status }}</p>
                            </article> -->
                        </div>
                        <div class="mainFooter "></div>
                    </section>        
                    
                </div>
            </div>
    
    </body>
</html>
