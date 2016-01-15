$(document).ready(function(){

//let's create arrays
var BA = [
    {display: "Arts &  Humantities", value: "Arts &  Humantities" }, 
    {display: "Communication", value: "Communication" }, 
    {display: "Economics", value: "Economics" },
    {display: "English", value: "English" },
	{display: "Film", value: "Film" }, 
    {display: "Fine Arts", value: "Fine Arts" },
	{display: "Hindi", value: "Hindi" }, 
    {display: "History", value: "History" },
	{display: "Journalism", value: "Journalism" }, 
    {display: "Maths", value: "Maths" },
	{display: "Political Science", value: "Political Science" }, 
    {display: "Sociology", value: "Sociology" },
	{display: "Statistics", value: "Statistics" }, 
    {display: "Vocational Course", value: "Vocational Course" }];
    
var BArch = [
    {display: "Agriculture", value: "Agriculture" }];
    
var BCA = [
    {display: "Frozen yogurt", value: "frozen-yogurt" }, 
    {display: "Booza", value: "booza" }, 
    {display: "Frozen yogurt", value: "frozen-yogurt" },
    {display: "Ice milk", value: "ice-milk" }];
	
var BBA = [
    {display: "MBA in Accounting", value: "Accounting" }, 
    {display: "MBA in Business Administration", value: "Business Administration" }, 
    {display: "MBA in Business Analysis", value: "Business Analysis" },
    {display: "MBA in Communications", value: "Communications" },
	{display: "MBA in Criminal Justice", value: "Criminal Justice" }, 
    {display: "MBA in Entrepreneurship", value: "Entrepreneurship" },
	{display: "MBA in General Management", value: " General Management" }, 
    {display: "MBA in Health Care Management", value: "Health Care Management" },
	{display: "MBA in International Business", value: "International Business" }, 
    {display: "MBA in Management Information Systems", value: "Management Information Systems" },
	{display: "MBA in Pharma", value: "Pharma" }, 
    {display: "MBA in Real Estate", value: "Real Estate" },
	{display: "MBA Salary", value: "Salary" }, 
    {display: "MBA in Organizational behavior", value: "Organizational behavior" }];
	
	
var btech = [
    {display: "Agriculture", value: "Agriculture" }, 
	{display: "Aronotical", value: "Aronotical" },
	{display: "Automobile", value: "Automobile" },
	{display: "Bio-Chemistry", value: "Bio-Chemistry" },
	{display: "Biomedical", value: "Biomedical" },
	{display: "Ceramics", value: "Ceramics" },
	{display: "Chemical", value: "Chemical" },
	{display: "Civil", value: "Civil" },
	{display: "Computer Science", value: "Computer Science" },
    {display: "Electronics/Telecommunication", value: "Electronics/Telecommunication" }, 
    {display: "Energy", value: "Energy" },
    {display: "Environmental", value: "Environmental" },
    {display: "Instrumentation", value: "Instrumentation" },
    {display: "Marine", value: "Marine" },
    {display: "Mechanical", value: "Mechanical" },
    {display: "Metallurgy", value: "Metallurgy" },
    {display: "Mineral", value: "Mineral" },
    {display: "Mining", value: "Mining" },
    {display: "Nuclear", value: "Nuclear" },
    {display: "Paint/Oil", value: "Paint/Oil" },
    {display: "Petroleum", value: "Petroleum" },
    {display: "Plastics", value: "Plastics" },
    {display: "Production/Industrial", value: "Production/Industrial" },
    {display: "Textile", value: "Textile" },
    {display: "Other Engineering", value: "Other Engineering" }];
	

var MA = [
    {display: "Anthropology", value: "Anthropology" }, 
    {display: "Arts & Humanities", value: "Arts & Humanities" },
    {display: "Communication", value: "Communication" },
    {display: "Economics", value: "Economics" },
    {display: "English", value: "English" },
    {display: "Film", value: "Film" },
    {display: "Fine arts", value: "Fine arts" },
    {display: "History", value: "History" },
    {display: "Journalism", value: "Journalism" },
    {display: "Maths", value: "Maths" }, 
    {display: "Energy", value: "Energy" },
    {display: "Environmental", value: "Environmental" },
    {display: "Political Science", value: "Political Science" },
    {display: "PR/ Advertising", value: "PR/ Advertising" },
    {display: "Psychology", value: "Psychology" },
    {display: "Sanskrit", value: "Sanskrit" },
    {display: "Sociology", value: "Sociology" },
    {display: "Statistics", value: "Statistics" }];

var MArch = [ {display: "Architecture", value: "Architecture"}];

var MCom = [ {display: "Commerce", value: "Commerce"}];

var MEd = [ {display: "Education", value: "Education"}];

var MPharma = [ {display: "Pharmacy", value: "Pharmacy"}];

var MSc = [ 
    {display: "Anthropology", value: "Anthropology"},
    {display: "Bio-Chemistry", value: "Bio-Chemistry"},
    {display: "Biology", value: "Biology"},
    {display: "Botany", value: "Botany"},
    {display: "Chemistry", value: "Chemistry"},
    {display: "Computers", value: "Computers"},
    {display: "Dairy Technology ", value: "Dairy Technology "},
    {display: "Electronics", value: "Electronics"},
    {display: "Environmental science", value: "Environmental science"},
    {display: "Food Technology", value: "Food Technology"},
    {display: "Geology", value: "Geology"},
    {display: "Home science ", value: "Home science "},
    {display: "Maths", value: "Maths"},
    {display: "Nursing", value: "Nursing"},
    {display: "Physics", value: "Physics"},
    {display: "Statistics", value: "Statistics"},
    {display: "Zoology", value: "Zoology"}];
                                                                              
var MTech = [
    {display: "Agriculture", value: "Agriculture" }, 
    {display: "Aronotical", value: "Aronotical" },
    {display: "Automobile", value: "Automobile" },
    {display: "Bio-Chemistry", value: "Bio-Chemistry" },
    {display: "Biomedical", value: "Biomedical" },
    {display: "Ceramics", value: "Ceramics" },
    {display: "Chemical", value: "Chemical" },
    {display: "Civil", value: "Civil" },
    {display: "Computer Science", value: "Computer Science" },
    {display: "Electronics/Telecommunication", value: "Electronics/Telecommunication" }, 
    {display: "Energy", value: "Energy" },
    {display: "Environmental", value: "Environmental" },
    {display: "Instrumentation", value: "Instrumentation" },
    {display: "Marine", value: "Marine" },
    {display: "Mechanical", value: "Mechanical" },
    {display: "Metallurgy", value: "Metallurgy" },
    {display: "Mineral", value: "Mineral" },
    {display: "Mining", value: "Mining" },
    {display: "Nuclear", value: "Nuclear" },
    {display: "Paint/Oil", value: "Paint/Oil" },
    {display: "Petroleum", value: "Petroleum" },
    {display: "Plastics", value: "Plastics" },
    {display: "Production/Industrial", value: "Production/Industrial" },
    {display: "Textile", value: "Textile" },
    {display: "Other Engineering", value: "Other Engineering" }];                                                                                        
                                                                                                   
                                                                                                   
var MBAPGDM = [
    {display: "Advertising/Mass Communication", value: "Advertising/Mass Communication" }, 
    {display: "Finance", value: "Finance" },
    {display: "HR/Industrial Relations ", value: "HR/Industrial Relations " },
    {display: "Information Technology ", value: "Information Technology " },
    {display: "International Business ", value: "International Business " },
    {display: "Marketing", value: "Marketing" },
    {display: "Systems", value: "Systems" },
    {display: "Other Management", value: "Other Management"},
    {display: " Operations", value: " Operations" }];                                                                                               
   
var MCA = [ {display: "Computers", value: "Computers"}];
 
var MS = [
    {display: "Cardiology", value: "Cardiology" }, 
    {display: "Dermatology", value: "Dermatology" },
    {display: "ENT", value: "ENT" },
    {display: "General Practitioner", value: "General Practitioner" },
    {display: "Gynecology", value: "Gynecology" },
    {display: "Hepatology", value: "Hepatology" },
    {display: "Immunology", value: "Immunology" },
    {display: "microbiology", value: "microbiology" },
    {display: "Neonatal", value: "Neonatal" },
    {display: "Nephrology", value: "Nephrology" }, 
    {display: "neurology", value: "neurology" },
    {display: "Obstetrics", value: "Obstetrics" },
    {display: "Ophthalmology", value: "Ophthalmology" },
    {display: "Orthopedic", value: "Orthopedic" },
    {display: "Pathology", value: "Pathology" },
    {display: "Oncology", value: "Oncology" },
    {display: "Pediatrics", value: "Pediatrics" },
    {display: "psychology", value: "psychology" },
    {display: "Psychiatry", value: "Psychiatry" },
    {display: "Radiology", value: "Radiology" },
    {display: "Rheumatology", value: "Rheumatology" }];

var PGDiploma = [
    {display: "Chemical", value: "Chemical" }, 
    {display: "Civil", value: "Civil" },
    {display: "Computers", value: "Computers" },
    {display: "Electrical", value: "Electrical" },
    {display: "Electronics", value: "Electronics" },
    {display: "Mechanical", value: "Mechanical" }];

var MVSC = [ {display: "Veterinary Science", value: "Veterinary Science"}];

var MCM = [ {display: "Computers and Management", value: "Computers and Management"}];
                                                                                                  
var twelth = [
    {display: "Science", value: "Science" }, 
    {display: "Commerce", value: "Commerce" },
    {display: "Humanities/Arts", value: "Humanities/Arts" }];                                                                                                  
                                                                                                 
var BBA = [ {display: "Management", value: "Management"}];

var BCom = [ {display: "Commerce", value: "Commerce"}];

var BEd = [ {display: "Education", value: "Education"}];

var BDS = [ {display: "Dentistry", value: "Dentistry"}];

var BHM = [ {display: "Hotel Management", value: "Hotel Management"}];                                                                                                    
                                                                                                     
var BPharma = [{display: "Pharmacy", value: "Pharmacy"}];                                                                                                
                                                                                                                            
//If parent option is changed
$("#parent_selection").change(function() {
        var parent = $(this).val(); //get option value from parent 
        
        switch(parent){ //using switch compare selected option and populate child
              case 'BA':
                list(BA);
                break;
              case 'BArch':
                list(BArch);
                break;              
              case 'BCA':
                list(BCA);
                break;
			  case 'BBA':
                list(BBA);
                break;
			  case 'btech':
                list(btech);
                break;
            case 'BPharma':
                list(BPharma);
                break;
            case 'BHM':
                list(BHM);
                break;
            case 'BDS':
                list(BDS);
                break;
            case 'BEd':
                list(BEd);
                break;
            case 'BCom':
                list(BCom);
                break;
            case 'BBA':
                list(BBA);
                break;
            case 'twelth':
                list(twelth);
                break;
                case 'MCM':
                list(MCM);
                break;
                case 'MVSC':
                list(MVSC);
                break;
                case 'PGDiploma':
                list(PGDiploma);
                break;
                case 'MS':
                list(MS);
                break;
                case 'MCA':
                list(MCA);
                break;
                case 'MBAPGDM':
                list(MBAPGDM);
                break;
                case 'MTech':
                list(MTech);
                break;
                case 'MSc':
                list(MSc);
                break;
                case 'MArch':
                list(MArch);
                break;
                case 'MCom':
                list(MCom);
                break;
                case 'MEd':
                list(MEd);
                break;				
                case 'MPharma':
                list(MPharma);
                break;
                case 'MA':
                list(MA);
                break;
            default: //default child option is blank
                $("#child_selection").html('');  
                break;
           }
});

//function to populate child select box
function list(array_list)
{
    $("#child_selection").html(""); //reset child options
    $(array_list).each(function (i) { //populate child options 
        $("#child_selection").append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
    });
}

});