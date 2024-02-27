<?php /* Template Name: Surveys Form */ ?>
<?php get_header(); ?>

<section class='survey_main'>
    <div class="container">
        <div class="form">
            <div class="form_main">
                <form class="survey_form" method="post" enctype="multipart/form-data">

                    <h2 class="survey_form_title">
                        <?php the_title(); ?>
                    </h2>
                    <div class="insideform">
                        <label for="name">Name</label>
                        <input id="name" placeholder="name" name="name" type="text"  pattern=".{3,}" 
                            autocomplete="off" title="enter at least 3 char" required>
                        <label for="Race/Ethnicity">Race/Ethnicity</label>
                        <select id="race_ethnicity" name="race_ethnicity">
                            <option disabled="disabled" selected="selected">Race/Ethnicity</option>
                            <option value="Asian">Asian</option>
                            <option value="African">African</option>
                            <option value="Latino">Latino</option>
                            <option value="Mixed Race">Mixed Race</option>
                        </select>

                        <label for="biological_Sex">Biological Sex</label>
                        <select id="biological_Sex" name="biological_Sex" >
                            <option disabled="disabled" selected="selected">Biological Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>

                        <label for="DOB">Date of Birth</label>
                        <input id="date_of_birth" placeholder="Date of Birth" name="date_of_birth" type="date"
                            autocomplete="off" required/>

                        <label for="zipcode">Zipcode</label>
                        <input id="zipcode" placeholder="Zipcode" name="zipcode"  type="text"
                            autocomplete="off" required/>

                        <label for="marital_status">Marital Status</label>
                        <select id="marital_status" name="marital_status" >
                            <option disabled="disabled" selected="selected">Marital Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                        </select>
                    </div>
                    <div class="insideform" id="submitdiv">
                        <label for="number_of_children">Number of Children</label>
                        <input id="children" name="children" placeholder="Number of Children"  min="0"
                            type="number" autocomplete="off" required/>

                        <label for="education">Education</label>
                        <select id="education" name="education">
                            <option disabled="disabled" selected="selected">Education</option>
                            <option value="highschool">HighSchool</option>
                            <option value="undergraduate">Undergraduate</option>
                            <option value="postgraduate">Postgraduate</option>
                        </select>

                        <label for="employement_status">Employement Status</label>
                        <select id="employement_status" name="employment">
                            <option disabled="disabled" selected="selected">Employment Status</option>
                            <option value="unemployed">Unemployed</option>
                            <option value="employed">Employed</option>
                            <option value="parttime">Part TIme</option>
                        </select>

                        <label for="contact">Contact</label>
                        <input id="contact" placeholder="Contact" name="contact" type="text"  
                            autocomplete="off" required/>

                        <label for="email">Email</label>
                        <input id="email" name="email" placeholder="@email" type="email"  autocomplete="off" required/>

                        <input type="file" accept="image/png, image/jpeg ,image/jpg" name="file" id="file" placeholder="uploadimage" title="Please Upload Image" required>

                        <input id="forminput" type="submit" value="SUBMIT" />
                    </div>

                    <div class="error" id="errorDiv"></div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
<pre>
<?php
// print_r($_FILES);
?>
