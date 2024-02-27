<?php
// Template Name: Survey Data
// table show karwane k liye
?>
<?php get_header(); ?>
<section class="survey_data">
    <div class="container">
        <div class="survey_data_main">
            <table>
                <thead>

                    <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Race/Ethinicity</th>
                        <th>Sex</th>
                        <th>DOB</th>
                        <th>ZipCode</th>
                        <th>Marital Status</th>
                        <th>Number of Child</th>
                        <th>Education</th>
                        <th>Employment Status</th>
                        <th>Contact</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php getSurveydata(); ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php 
?>
<?php get_footer(); ?>