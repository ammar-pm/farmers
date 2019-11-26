@extends('layouts.site')
@section('content')

<div class="container m-t-md">

<div class="row">

<div class="col-md-3">

<ul class="nav nav-pills nav-stacked">
  <li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
  <li><a data-toggle="tab" href="#datasets">Datasets</a></li>
  <li><a data-toggle="tab" href="#files">Files</a></li>
  <li><a data-toggle="tab" href="#posts">Posts</a></li>
  <li><a data-toggle="tab" href="#widgets">Widgets</a></li>
  <li><a data-toggle="tab" href="#menus">Menus</a></li>
  <li><a data-toggle="tab" href="#periods">Periods</a></li>
  <li><a data-toggle="tab" href="#governorates">Governorates</a></li>
  <li><a data-toggle="tab" href="#indicators">Indicators</a></li>
  <li><a data-toggle="tab" href="#users">Users</a></li>
  <li><a data-toggle="tab" href="#settings">Settings</a></li>
  <li><a data-toggle="tab" href="#algolia">Search Engine</a></li>
  <li><a data-toggle="tab" href="#api">API</a></li>
</ul>

</div><!--Col-->

<div class="col-md-9">

	<div class="tab-content">

		<div id="overview" class="tab-pane fade in active">

			<h4>Overview</h4>

			<p>Indicators.ps is a modern, web-based application written with Laravel, Vue.js, PHP7, Bootstrap 3.3, LESS CSS, and HTML5. The objective of the application is to serve as a central resource for PCBS to present datasets to its users. Modern browsers up to three versions prior are supported as well as a responsive layout for varying screen sizes. The "backend" features are for internal users to manage what's rendered on the "frontend".</p>

			<p>The application is hosted in a scalable EC2 instance in <a href="https://aws.amazon.com" target="_blank">Amazon Web Services</a> in Frankfurt, Germany. Changes pushed to the master branch are automatically pushed to the live server.</p>

			<p>To deploy the project locally, clone the repo, run the database migrations, configure the <code>.env</code>, and follow Laravel installation instructions.</p>

			<p>A RESTful API is used to internally power many features of the application. It is also available for 3rd party use such as integration with a mobile app.</p>

			<p>Admin and editor users are considered backend users.</p>

			<p>The application fully uses HTTPS encryption.</p>

			<p>All resources are scoped by language, enabling a completely bilingual (English and Arabic) experience. All translations for labels are in the <code>/resources/lang</code> directory either <code>en</code> or <code>ar</code>. Bootstrap flipped and a RTL focused CSS file are used when the language is set to Arabic.</p>

			<p>Registration for frontend users is optional. If registered, frontend users are able to favorite and download datasets as well as specify a language preference. All users (including those authenticated via social) are managed in the <a href="/users">Users</a> page.</p>

			<p>This help page is only visible to backend users.</p>

			<p>Version: 1</p>

		</div>

		<div id="datasets" class="tab-pane fade">

			<h4>Datasets</h4>

			<p>Datasets are the primary feature of the application. Nearly all other features relate to datasets.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/dataset-editing.png" class="img-responsive">

			<p>Datasets can use one of five visualization libraries:</p>

			<ul class="list-group">
				<li class="list-group-item"><a href="http://www.chartjs.org/" target="_blank">Chart.js</a> Supports two categories, configurable options, line, bar, horizontal bar, doughnut, pie, radar, and table views.</li>
				<li class="list-group-item"><a href="https://www.highcharts.com" target="_blank">Highcharts</a> Supports three and four categories, configurable options, line, and bar views.</li>
				<li class="list-group-item"><a href="https://plot.ly" target="_blank">Plotly</a> Use to integrate charts created in Plotly, a 3rd party charting platform.</li>
				<li class="list-group-item"><a href="https://www.tableau.com" target="_blank">Tableau</a> Use to integrate visualizations created in Tableau, a 3rd party visualization platform.</li>
				<li class="list-group-item"><a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/iframe" target="_blank">iFrame</a> Use to embed 3rd party services that enable iframe integrations such as <a href="https://carto.com" target="_blank">Carto</a>.</li>
			</ul>

			<p><span class="label label-danger">Notes</span></p>

			<p>Dataset configurable options are based on the library, file, and type settings chosen.</p>

			<p>Each dataset has a unique, shareable URL.</p>

		</div><!--Tab-->

		<div id="files" class="tab-pane fade">

			<h4>Files</h4>

			<p>Files are a required resource to create a working dataset. Manage all files from the <a href="/files" target="_blank">Files</a> page.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/files-grid.png" class="img-responsive">

			<p>Once a file has been uploaded, choose the desired file when editing a dataset. You can search the file by title or unique ID.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/datasets-files-form.png" class="img-responsive">

			<p><span class="label label-danger">Note</span></p>

			<p>Files must be in CSV, XLS, or XLSX format. Other formats are restricted from being uploaded.</p>

		</div><!--Tab-->

		<div id="posts" class="tab-pane fade">

			<h4>Posts</h4>

			<p>Posts are single pages of informational content.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/post-topic-single.png" class="img-responsive">

			<p>Posts are rendered on the frontend based on the <span class="label label-primary">TYPE</span>.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/posts-form.png" class="img-responsive">

			<p><strong>Post types</strong></p>

			<ul class="list-group">

				<li class="list-group-item"><strong>Stories</strong> - the latest 3 stories with <span class="label label-primary">Featured</span> enabled will render on the landing page. All stories will render on the <a href="/stories" target="_blank">Stories</a> page.</li>
				<li class="list-group-item"><strong>News</strong> - the latest 4 news posts with <span class="label label-primary">Featured</span> enabled will render on the landing page. All news will render on the <a href="/news" target="_blank">News</a> page.</li>
				<li class="list-group-item"><strong>Pages</strong> - pages will not render anywhere automatically unless linked to in the menus.</li>
				<li class="list-group-item"><strong>Topics</strong> - six topics will render on the landing page. Links to topics are generated dynamically in the topics menu item.</li>

			</ul>

			<p><span class="label label-danger">Notes</span></p>

			<p>Posts must have <span class="label label-primary">Public</span> enabled to render on the frontend.</p>
			<p>Enable <span class="label label-primary">Comments</span> to allow for Facebook commenting on the post.</p>

		</div><!--Tab-->

		<div id="widgets" class="tab-pane fade">

			<h4>Widgets</h4>

			<p>Widgets are HTML enabled, content blocks that render on the library and single dataset pages.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/widgets-sidebar.png" class="img-responsive">

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/widgets-form.png" class="img-responsive">

		</div><!--Tab-->

		<div id="menus" class="tab-pane fade">

			<h4>Menus</h4>

			<p>Manage the header and footer menus from the <a href="/menus" target="_blank">Menus</a> page.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/menus.png" class="img-responsive">

			<p>Menu items are rendered based on the locations and sort order chosen.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/menu-locations.png" class="img-responsive">

			<p><label class="label label-danger">NOTE</label></p>

			<p>Dynamic menu items are: topics, governorates, language switcher, favorites, authentication links, and backend links.</p>

		</div><!--Tab-->

		<div id="periods" class="tab-pane fade">

			<h4>Periods</h4>

			<p>Periods are used as a filtering attribute for datasets. After creating a period, you can assign it in each related dataset.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/periods.png" class="img-responsive">

			<p>Then, from the library page, users are able to filter datasets by the related periods.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/periods-filtering.png" class="img-responsive">

		</div><!--Tab-->

		<div id="governorates" class="tab-pane fade">

			<h4>Governorates</h4>

			<p>Each governorate presents a dedicated page with assigned datasets.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/governorate.png" class="img-responsive">

			<p>Users can also filter by governorate on the library page.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/filter-by-governorate-library.png" class="img-responsive">

			<p>Assign governorates in the dataset's form.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/datasets-form-governorates.png" class="img-responsive">

			<p>Add a GEOJSON map file to render a layer on the governorate map and/or add coordinates to render a marker.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/governorates-form.png" class="img-responsive">

		</div><!--Tab-->

		<div id="indicators" class="tab-pane fade">

			<h4>Indicators</h4>

			<p>Indicators are snippets of reusable texts and icons throughout the application. Indicators are used as a carousel on the landing page as well as single dataset pages.</p>

			<p class="lead text-center">Indicators infinity carousel on the landing page</p>
			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/indicators-landing-page.png" class="img-responsive">

			<p class="lead text-center">Indicators on a single dataset page</p>
			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/indicators-dataset-page.png" class="img-responsive">
			

		    <p class="m-t-md">To render indicators on a single dataset page, edit the desired dataset and choose the appropriate indicators.</p>

			<center><img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/indicators.png" class="img-responsive"></center>

			<p class="lead text-center m-t-md">Indicators are scoped by language. Choose the language when editing an indicator.</p>
			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/indicators-arabic.png" class="img-responsive">

		</div><!--Tab-->

		<div id="users" class="tab-pane fade">

			<h4>Users</h4>

			<p>Registration for public users is optional. By registering, users are able to favorite datasets and download source files. Users can save their language preference in their profile.</p>

			<p class="lead">User Roles</p>

			<p><strong>Admins</strong></p>

			<p>Admin users can assign <label class="badge badge-primary">ADMIN</label>, <label class="badge badge-primary">EDITOR</label>, or <label class="badge badge-primary">MEMBER</label> role to other users as well as trash users.</p>

			<p>Admins have unrestricted access to all features.</p>

			<p><strong>Editors</strong></p>

			<p>Editors are internal users like Admins, however there are feature restrictions. Editors can only manage datasets, files, and posts. All other backend features are invisible and blocked from editors.</p>

			<p><strong>Members</strong></p>

			<p>Members are public users who chose to register for an account. Registration is possible via email, Google, and/or Facebook.</p>

			<p>New user registrations trigger a <em>New user has signed up on indicators.ps email</em>.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/new-user.png" class="img-responsive">

			<p class="lead text-center m-t-md">The email used to send the notification is managed in <a href="/app/settings" target="_blank">Settings</a> / <label class="badge badge-primary">Advanced</label> tab.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/new-user-notifications-email.png" class="img-responsive">



		</div><!--Tab-->

		<div id="settings" class="tab-pane fade">

			<h4>Settings</h4>

			<p><a href="/settings" target="_blank">Settings</a> are configuration values used throughout the application. Only admins are able to configure settings.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/settings.png" class="img-responsive">

			<p><strong>General tab</strong></p>

			<ul class="list-group">
				<li class="list-group-item"><strong>Site Name</strong> Used globally such as in the title and footer.</li>
				<li class="list-group-item"><strong>Site Description</strong> Used in the meta description.</li>
				<li class="list-group-item"><strong>Tag Line</strong> Used in the title.</li>
				<li class="list-group-item"><strong>Phone, Fax, Email, and Address</strong> Not currently being used.</li>
			</ul>

			<p><strong>Social tab</strong></p>

			<p>Profile URLs render as icons on the frontend. Skip the URL to hide the icon.</p>

			<ul class="list-group">
				<li class="list-group-item"><strong>OG Image URL</strong> Image used in social sharing.</li>
				<li class="list-group-item"><strong>Facebook URL</strong> Link to Facebook profile.</li>
				<li class="list-group-item"><strong>LinkedIn URL</strong> Link to LinkedIn profile.</li>
				<li class="list-group-item"><strong>YouTube URL</strong> Link to YouTube profile.</li>
				<li class="list-group-item"><strong>Twitter URL</strong> Link to Twitter profile.</li>
			</ul>

			<p><strong>Home tab</strong></p>

			<p>English and Arabic settings used for the landing (home) page.</p>

			<ul class="list-group">
				<li class="list-group-item"><strong>Title</strong> Title of the page.</li>
				<li class="list-group-item"><strong>Description</strong> HTML enabled description of the page.</li>
				<li class="list-group-item"><strong>Call to Actions</strong> HTML enabled content after the description.</li>
				<li class="list-group-item"><strong>Featured Video</strong> YouTube URL of featured video.</li>
				<li class="list-group-item"><strong>Featured Video Thumbnail</strong> URL of image to use in the thumbnail of the featured video.</li>
				<li class="list-group-item"><strong>Featured Description</strong> Content aside the featured video.</li>
			</ul>

			<p><strong>Advanced tab</strong></p>

			<ul class="list-group">
				<li class="list-group-item"><strong>New User Notifications Email</strong> Email address that receives new user notifications.</li>
				<li class="list-group-item"><strong>Google Analytics ID</strong> Property ID from <a href="https://analytics.google.com" target="_blank">Google Analytics</a> to send user tracking data.</li>
				<li class="list-group-item"><strong>Facebook App ID</strong> App ID from <a href="https://developers.facebook.com">Facebook Developers</a> to enable Facebook comments.</li>
				<li class="list-group-item"><strong>Custom CSS</strong> CSS code rendered after all core CSS, before the head to allow for inline styling customizaiton.</li>
			</ul>

		</div><!--Tab-->

		<div id="algolia" class="tab-pane fade">

			<h4>Search Engine</h4>

			<a href="https://algolia.com" target="_blank"><img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/algolia-logo.svg" width="150"></a>

			<p>The search engine that powers the header search and library is <a href="https://algolia.com" target="_blank">Algolia</a>.</p>

			<p>Users can search in the header from any page. Suggestions are typo-tolerant and instant. Users click on a suggestion item to view the dataset. The filters and sorting options in the library are also powered by Algolia. Customize the ranking and search algorithm in your account's dashboard.</p>

			<img src="https://s3.eu-central-1.amazonaws.com/indicatorsps/header-search.png" class="img-responsive">

		</div><!--Tab-->

		<div id="api" class="tab-pane fade">

			<h4>API</h4>

			<p>The application uses a versioned, RESTful API design with token-based authentication. Resource collections are returned in JSON.</p>

			<p>Endpoint format is {{ env('APP_URL') }}/api/v1/{resource}. Generate a full list of API and web endpoints via artisan.</p>

			<p>Generate a API token in the <a href="/settings">User Settings</a> <span class="label label-default">API</span> tab.</p>

			<p><strong>API resources with CRUD support</strong></p>

			<ul class="list-group">
				<li class="list-group-item">Datasets</li>
				<li class="list-group-item">Files</li>
				<li class="list-group-item">Governorates</li>
				<li class="list-group-item">Indicators</li>
				<li class="list-group-item">Periods</li>
				<li class="list-group-item">Topics</li>
			</ul>

		</div><!--Tab-->

	</div><!--TabContent-->

</div><!--Col-->

</div><!--Row-->

</div><!--Container-->

@endsection