$(document).ready(function ($) {
    "use strict";



    try {

        
        // ------- owlCarousel ------- //
		
		$('.owl_caroussel_3cm4').owlCarousel({
			loop:true,
			margin:10,
			nav:true,
			dots: true,
			responsive:{
				0:{
					items:4
				},
				600:{
					items:3
				},
				1000:{
					items:1
				}
			}
		})
		
		
        // ------- contact form validate ------- //
 
 
        $("#forminscription").validate({
        rules: {
                     
            'nom': {
                required: true,
            },
            'prenom': {
                required: true,
            },
            'pseudo': {
                required: true,
                minlength: 8
            },
            'email': {
                required: true,
                email: true
            },
             'password': {
                required: true,
                minlength:8,
                 
            },
            'password2': {
                required: true,
                equalTo:("#password"),
                 
            },
            'type_user': {
                required: true,     
            },
            
            'datenaiss': {
                required: true,     
            },
            'adresse': {
                required: true,  
                minlength: 3
            },
            'numtel': {
                required: true,  
                minlength: 8,
            },
            'photoprofil': {
                required: true,
            },
			
        },
        messages: {
            
            'nom': {
                required: 'Entrer votre nom',
            },
            'prenom': {
                required: 'Entrer votre prenom',
            },
            'pseudo': {
                required: 'Entrer votre pseudo',
                minlength: 'le pseudo contient 8 lettres au minimum'
            },
            
            'email': {
                required: 'Email est obligatoire',
                email: 'user@user.com'
            },
            'password': {
                required: 'mot de pass est obligatoire',
                minlength: 'mot de pass invalide'
            },
            'password2': {
                required: 'mot de pass est obligatoire',
                equalTo: 'mot de pass invalide'
            },            
            'type_user': {
                required: 'choisir le type de compte',     
            },
            'datenaiss': {
                required: 'Ajouter votre date de naissance',     
            },
            'adresse': {
                required: 'ajouter une adresse',  
                minlength:'minimum 3 lettres'
            },
            'numtel': {
                required: 'ajouter votre numéro',  
                minlength: '8 chiffres'
        },
            'photoprofil': {
                required: 'ajouter une photo de profil',
            }
        }
    });
         

     
	
       
    
    $("#formcnx").validate({
        rules: {
                     
            'email': {
                required: true,
                email: true
            },
             'password': {
                required: true,
                minlength:8,
                 
            },
			
        },
        messages: {
            
            'email': {
                required: 'Email est obligatoire',
                email: 'user@user.com'
            },
            'password': {
                required: 'mot de pass est obligatoire',
                minlength: 'mot de pass invalide'
            }        
        }
    });

    } 
	catch (err) { 
	
	}


});


jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Veuillez insérer seulement des caractères");












