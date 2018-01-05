//listener on date of birth field

//function getPatientAge(birthdate) {
//if (isDate($('#birthdate').val())) {
//        var age = calculateAge(parseDate($('#birthdate').val()), new Date());
//      	$("#patient_age").val(age);   
//      } else {
//        $("#patient_age").val('');   
//      }  	
//}


function getPatientAge(birthdate) {
	var age = '';
	if (isDate(birthdate)) {
        age = calculateAge(parseDate(birthdate), new Date());      	   
    } 
	return age;
}

//convert the date string in the format of dd/mm/yyyy into a JS date object
function parseDate(dateStr) {
  var dateParts = dateStr.split("/");
  return new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
}

//is valid date format
function calculateAge (dateOfBirth, dateToCalculate) {
    var calculateYear = dateToCalculate.getFullYear();
    var calculateMonth = dateToCalculate.getMonth();
    var calculateDay = dateToCalculate.getDate();

    var birthYear = dateOfBirth.getFullYear();
    var birthMonth = dateOfBirth.getMonth();
    var birthDay = dateOfBirth.getDate();

    var age = calculateYear - birthYear;
    var ageMonth = calculateMonth - birthMonth;
    var ageDay = calculateDay - birthDay;

    if (ageMonth < 0 || (ageMonth == 0 && ageDay < 0)) {
        age = parseInt(age) - 1;
    }
    return age;
}

function isDate(txtDate) {
  var currVal = txtDate;
  if (currVal == '')
    return true;

  //Declare Regex
  var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
  var dtArray = currVal.match(rxDatePattern); // is format OK?

  if (dtArray == null)
    return false;

  //Checks for dd/mm/yyyy format.
  var dtDay = dtArray[1];
  var dtMonth = dtArray[3];
  var dtYear = dtArray[5];

  if (dtMonth < 1 || dtMonth > 12)
    return false;
  else if (dtDay < 1 || dtDay > 31)
    return false;
  else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
    return false;
  else if (dtMonth == 2) {
    var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
    if (dtDay > 29 || (dtDay == 29 && !isleap))
      return false;
  }

  return true;
}
//////* End of functions to calculate age based on the birthdate field as long as the id is "birthdate"*//////////////

/* function calculatePhysicalComplexion(height,wristCircumference,gender)
	Calculates physical complexion by dividing Height between the wrist circumference.  
Results are calculated according to these parameters:
	Pequeña:Hombres : > 10.4  | Mujeres: >11.0
Mediana: Hombres : 9.6 - 10.4  | Mujeres: 10.1 - 11.0
Grande:Hombres : < 9.6  | Mujeres: <10.1 */

function calculatePhysicalComplexion(height,wristCircumference,gender){
	 
	var result = height/wristCircumference;
	var complexion = "";

	//Calculating depending on gender
	if(gender == "female"){
		if(result >= 11.1){complexion = "Pequeña"; }
		else if(result >= 10.1 && result <= 11.0){complexion = "Mediana";}
		else{ complexion = "Grande"; }
	}
	///Male gender
	else{
		if(result >= 10.5){complexion = "Pequeña"; }
		else if(result >= 9.7 && result <= 10.4){complexion = "Mediana";}
		else{ complexion = "Grande"; }
	}
	//Writing the value into the input
	return complexion;					
}
	
	
	
/*public function returnAgeGroup(age) 
 * returns the group to help calculate the Body Fat Index according to the constant DurninWomersleConstant
 * */
function returnAgeGroup(age){
	var group;
	
	switch(true) {
	    case (age <= 19) :
	        group = 1;
	        break;
	    case (age >= 20 && age <= 29):
	    	group = 2;
	        break;
	    case (age >= 30 && age <= 39):
	    	group = 3;
	        break;
	    case (age >= 40 && age <= 49):
	    	group = 4;
	        break;
	    case (age >= 50):
	    	group = 5;
	        break;
	    default:
	    	group = 0;
	}
	return group;
}


/* function calculateBodyFat(patientAge,patientGender,skinfold)
  Calculates  and return the physical complexion by dividing Height between the wrist circumference.  
Results are calculated according to these parameterse:
		IGC = (4.95 / DC) - 4.5
	DC se calcula con la fórmula de Durnin/Womersley:
		DC= C - ( M * Log( Suma Pliegues)) 				

Tabla constantes C y M para Fórmula Durnin/Womersley para Hombres
C
	16-19 años : 1.1620
	20-29 años : 1.1631
	30-39 años : 1.1422
	40-49 años : 1.1620
	50+   años : 1.1715		
M
	16-19 años : 0.0630
	20-29 años : 0.0632
	30-39 años : 0.0544
	40-49 años : 0.0700
	50+   años : 0.0779

Tabla constantes C y M para Fórmula Durnin/Womersley para Mujeres	
	EDAD:	
C
	16-19 años : 1.1549
	20-29 años : 1.1599
	30-39 años : 1.1423
	40-49 años : 1.1333
	50+   años : 1.1339			
M
	16-19 años : 0.0678
	20-29 años : 0.0717
	30-39 años : 0.0632
	40-49 años : 0.0612
	50+   años : 0.0645	
	
	La tabla anterior está declarada en la constante DurninWomersleyConstant
*/

function calculateBodyFat(patientAge,patientGender,skinfold){
	
	var DurninWomersleyConstant = {
			'male' : {'c' :  {1 : 1.1620, 2 : 1.1631, 3 : 1.1422, 4 : 1.1620, 5 : 1.1715}, 'm' :  {1: 0.0630,  2: 0.0632,  3: 0.0544,  4 : 0.0700, 5 :0.0779 }},
			'female' : {'c' : {1: 1.1549, 2: 1.1599, 3: 1.1423, 4: 1.1333, 5: 1.1339}, 'm' : {1: 0.0678, 2: 0.0717, 3: 0.0632, 4: 0.0612, 5 : 0.0645}}
	};	
	
	var patientAgeGroup =  returnAgeGroup(patientAge) ;
	var m = DurninWomersleyConstant[patientGender]['m'][patientAgeGroup];
	var c = DurninWomersleyConstant[patientGender]['c'][patientAgeGroup];	
	
	//DC= C - ( M * Log(Suma Pliegues)) 
	var dc = c - (m * Math.log(skinfold));
	// bfp stands fo body fat percentage
	var bfp = (4.95 / dc ) - 4.5;
	
	return bfp;

}