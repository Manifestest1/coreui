<!DOCTYPE html>
<html>
<head>
<link href="{{ asset('css/pdf-style.css') }}" rel="stylesheet">

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
                    <li>contact: <a href="tel:{{ $user->employee->phone }}" target="_blank">{{ $user->employee->phone }}</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div id="mainArea" class="quickFade delayFive">
            <section>
                <article>
                    <div class="sectionTitle">
                        <h1>Objective</h1>
                    </div>
                    <div class="sectionContent">
                        <p>To contribute best of my knowledge, skill and ability in the growth of the organization where will be working and also attain new height in my field of work.</p>
                    </div>
                </article>
                <div class="clear"></div>
            </section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Work Experience</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p class="subDetails">April 2011 - Present</p>
					<p>{{ $user->employee->work_experience }}</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Key Skills</h1>
			</div>
			
			<div class="sectionContent">
				<ul class="keySkills">
					<li>{{ $user->employee->current_working_skill }}</li>
				</ul>
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Education</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p class="subDetails">Qualification</p>
					<p>{{ $user->employee->qualification }}</p>
				</article>
			</div>
			<div class="clear"></div>
		</section>

        <section>
			<div class="sectionTitle">
				<h1>Current Working Skill</h1>
			</div>
			
			<div class="sectionContent">
				<article>
					<p>{{  $user->employee->current_working_skill }}</p>
				</article>
			</div>
			<div class="clear"></div>
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
			<div class="clear"></div>
		</section>

        <section>
			<div class="sectionTitle">
				<h1>Certification</h1>
			</div>

            <div class="sectionContent">
				<ul class="keySkills">
                    @foreach(explode(',', $user->employee->certifications) as $certification)
                            <li>{{ trim($certification) }}</li>
                    @endforeach
				</ul>
			</div>
			<div class="clear"></div>
		</section>

		<section>
			<div class="sectionTitle">
				<h1>Personal Details</h1>
			</div>
			
			<div class="sectionContent marginFooter">
				<article>
					<p class="subDetails">Permanent Address :  {{ $user->employee->permanent_address }}</p>
                    <p class="subDetails">Adhar Card No:  {{ $user->employee->adhar_card_no }}</p>
                    <p class="subDetails">Languages:  {{ $user->employee->languages }}</p>
                    <p class="subDetails">Hobbies:  {{ $user->employee->hobbies }}</p>
                    <p class="subDetails">City:  {{ $user->employee->city }}</p>
                    <p class="subDetails">State:  {{ $user->employee->state }}</p>
                    <p class="subDetails">Country:  {{ $user->employee->country }}</p>
                    <p class="subDetails">Pin Code:  {{ $user->employee->pincode }}</p>
                    <p class="subDetails">Gender:  {{ $user->employee->gender }}</p>
				</article>
			</div>
			<div class="clear mainFooter "></div>
		</section>        
		
	</div>
</div>
</body>
</html>