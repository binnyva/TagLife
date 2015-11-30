<script>
var api_base_url = "<?php echo $config['site_url'] ?>";
var all_tags = <?php echo json_encode($all_tags); ?>;
var date;
function init(){
	date = moment("<?php echo $date ?>");

	$("#next-day").click(nextDay);
	$("#prev-day").click(prevDay);
	$("h2").swipe({
		swipeLeft:function(event, direction, distance, duration, fingerCount) {
			nextDay();
		},
		swipeRight:function(event, direction, distance, duration, fingerCount) {
			prevDay();
		}
	});

	$("#tags").tagit({
		availableTags: all_tags,
	    autocomplete: {delay: 0, minLength: 2},
	    afterTagAdded: tagged,
	    afterTagRemoved: untagged
	});
}

function tagged(e, tag_info) {
	var tag = tag_info['tagLabel'];
}

function untagged() {

}

function nextDay() {
	getDay(1);
}
function prevDay() {
	getDay(-1);
}

function getDay(direction) {
	date = date.add(direction, 'day');

	loading();
	$.ajax(	{"url"		: api_base_url + "api/entry/get_tags.php", 
			"dataType"	: "json", 
			"data"		: {"date": date.format("YYYY-MM-DD")},
			"type"		: "GET",
			"success"	: setTags
	});
}

function setTags(data) {
	loaded();
	$("#date").html(date.format('Do MMM, YYYY'));
	$("#tags").tagit("removeAll");
	for(var index in data) $("#tags").tagit("createTag", data[index]);

}
</script>

<div class="container">
<div class="row"><h2><span id="prev-day" class="glyphicon glyphicon-chevron-left"></span>
<span id="date"><?php echo date("d\<\s\u\p\>S\<\/\s\u\p\> M, Y", strtotime($date)) ?></span>
<span id="next-day" class="glyphicon glyphicon-chevron-right"></span></h2></div>

<div class="row">
<form id="tags-input" action="">
<input type="text" name="tags" id="tags" value="<?php echo implode(",", $todays_tags) ?>" />
<!-- <input type="button" class="btn btn-primary" value="+" /> -->
</form>
</div>

<div class="row">
<ul id="possible-tags">
</ul>
</div>

</div>