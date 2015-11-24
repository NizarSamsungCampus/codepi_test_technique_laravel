$(document).ready(function () {
	var ville;
	var tags;
	var prix;
	var contenu;
	var object;
	var results;
	var akhi;
	var divResultats = $("#concerts");
	var divLinks = $("#pagination");
	var need;
	var divs;
	var pageAsked;
	$("#rechercher").on("submit", function (e) {
		e.preventDefault();
		var filtres = $(".filtres");
		ville = filtres[1].value;
		tags = filtres[2].value;
		prix = filtres[3].value;
		object = {ville: ville, tags: tags, prix: prix};
		$.ajax("search", {
			data: object,
			dataType : 'json',
			type: "GET",
			success: success, 
			error : error
		});
	});

	function error(data) {
		console.log(data);
	}

	function success(data) {
		divResultats.html("");

		for (i = 0; i < data.data.length; i++) {
			akhi = data.data[i];
			contenu = "<div class='figureconcert'><h3 class='specialtitle'>"+akhi.artiste+" @ "+akhi.lieu+" - "+akhi.ville+"</h3>";
			contenu += "<img class='concertimage' alt='"+akhi.artiste+"' src='../resources/assets/images/"+akhi.image+"'/>";
			contenu += "<div class='infoconcert'><p>"+akhi.date+"<span class='right'>Prix : <strong>"+akhi.prix+",00€</strong></span></p>";
			contenu += "<p>"+akhi.tags+"<span class='right'><a class='affichebutton' href='concert/"+akhi.id_concert+"'>Voir l'affiche -></a>";
			contenu += "</span></p></div></div>";
			need = divResultats.html();
			divResultats.html(need+contenu);
		}
		divLinks.html("");
		divLinks.html("<ul class='pagination'>")
		for (a = 1; a <= data.last_page; a++) {
			contenu = "<span";
			if (data.currentPage == a) {
				contenu += " class='active'";
			}
			contenu += "><li>"+a+"</li></span>";
			need = divLinks.html();
			divLinks.html(need + contenu);
		}
		need = divLinks.html();
		divLinks.html(need + "</ul>");
		var jibril = $("li");
		jibril.on('click', function (e) {
			pageAsked = e.toElement.innerHTML;
			object = {ville: ville, tags: tags, prix: prix};
			$.ajax("search?page="+pageAsked, {
				data: object,
				dataType : 'json',
				type: "GET",
				success: success, 
				error : error
			});			
		});
	}
});