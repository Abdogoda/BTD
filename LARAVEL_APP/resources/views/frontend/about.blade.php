@extends('layouts.frontend.master')
@section('title') About BT @endsection
@section('css')
    <!-- Slick Slider  CSS -->
  <link rel="stylesheet" href="{{asset('assets/frontend/plugins/slick-carousel/slick/slick.css')}}">
  <link rel="stylesheet" href="{{asset('assets/frontend/plugins/slick-carousel/slick/slick-theme.css')}}">
@endsection
@section('content')
<section class="page-title bg-1">
	<div class="overlay"></div>
	<div class="container">
			<div class="row">
					<div class="col-md-12">
							<div class="block text-center">
									<span class="text-white">About BT</span>
									<h1 class="text-capitalize text-lg">What is BT</h1>
							</div>
					</div>
			</div>
	</div>
</section>

<section class="section about-page">
<div class="container">
	<div class="row">
		<div class="col-lg-4">
			<h2 class="title-color">What is Brain Tumor?</h2>
			<div class="divider mt-4 mb-5 mb-lg-0"></div>
		</div>
		<div class="col-lg-8">
			<p>{{$siteSettings['about_bt']->value ?? 'A brain tumor is a growth of cells in the brain or near it. Brain tumors can happen in the brain tissue. Brain tumors also can happen near the brain tissue. Nearby locations include nerves, the pituitary gland, the pineal gland, and the membranes that cover the surface of the brain. Brain tumors can begin in the brain. These are called primary brain tumors. Sometimes, cancer spreads to the brain from other parts of the body. These tumors are secondary brain tumors, also called metastatic brain tumors.'}}</p>
		</div>
	</div>
</div>
</section>

@if ($tumors->count() > 0)
<section class="fetaure-page ">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="title-color">Types of Brain Tumors </h2>
				</div>
				<div class="col-lg-12 mt-3">
					<div class="row">
						@forelse ($tumors as $tumor)
						<div class="col-lg-2 col-md-4 mb-3">
							<a href="#{{strtolower(str_replace(' ', '', $tumor->title))}}" class="about-block-item mb-5 mb-lg-0">
								<img src="{{$tumor->picture ? asset('storage/'.$tumor->picture) : asset('assets/frontend/images/defualts/tumor.jpg')}}" alt="{{$tumor->title}}" style="max-width: 100%;" class="img-fluid w-100">
								<h4 class="mt-3 text-center">{{$tumor->title}}</h4>
							</a>
						</div>
						@empty
						<div class="col-12 mt-3 text-center text-muted border p-2">There is no treatments available!</div>
						@endforelse
					</div>
				</div>
				<div class="col-12 mt-3">
					@forelse ($tumors as $tumor)
								<div id="{{strtolower(str_replace(' ', '', $tumor->title))}}" class="row pt-5 pb-3 border-bottom">
									<img src="{{$tumor->picture ? asset('storage/'.$tumor->picture) : asset('assets/frontend/images/defualts/tumor.jpg')}}" class="col-md-3 mb-3" alt="{{$tumor->title}}" style="height: fit-content;">
									<div class="col-md-9">
										<h3>{{$tumor->title}} Tumor</h3>
										<p>{!! $tumor->description !!}</p>
									</div>
								</div>
						@empty
										<div class="col-12 mt-3 text-center text-muted border p-2">There is no treatments available!</div>
						@endforelse
				</div>
			</div>
		</div>
	</section>
@endif


<section class="section about-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h2 class="title-color">Causes and Risk Factors</h2>
				<div class="divider mt-4 mb-5 mb-lg-0"></div>
			</div>
			<div class="col-lg-8">
				<p>The exact cause of brain tumors is not fully understood, but several risk factors have been identified. Genetic predispositions play a significant role, with certain inherited conditions such as neurofibromatosis, Li-Fraumeni syndrome, and von Hippel-Lindau disease increasing the likelihood of developing brain tumors. Environmental factors, although less clearly defined, may also contribute.</p>
				<p>Exposure to ionizing radiation, for instance, is a known risk factor, particularly for those who have undergone radiation therapy for other cancers. Additionally, a history of exposure to certain chemicals, such as those found in industrial environments, may be linked to higher incidences of brain tumors.</p>
			</div>
		</div>
	</div>
	</section>
	

<section class="section awards">
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<h2 class="title-color">Treatment of Tumors</h2>
			<div class="divider mt-4 mb-5 mb-lg-0"></div>
		</div>
		<div class="col-lg-9 row">
			<div class="col-12">
				<p>The treatment of brain cancer varies widely depending on factors such as the type, location, size, and stage of the tumor, as well as the patient's overall health and preferences. Here's an overview of the common treatment options for brain cancer:</p>
			</div>
			@forelse ($treatments as $treatment)
					<div class="col-12 mt-3">
						<h4>{{$loop->iteration}}. {{$treatment->title}}:</h4>
						<p>{!! $treatment->description !!}</p>
					</div>
							
			@empty
							<div class="col-12 mt-3 text-center text-muted border p-2">There is no treatments available!</div>
			@endforelse
		</div>
	</div>
</div>
</section>

<section class="section testimonial">
<div class="container">
	<div class="row">
		<div class="col-lg-6 d-none d-md-block ">
			
				<img src="{{asset('assets/frontend/images/about/hope.jpg')}}" alt="about-image" class="img-fluid">
		</div>
		<div class="col-lg-6 ">
			<div class="section-title">
				<h2 class="mb-4">Greate Healing Stories</h2>
				<div class="divider  my-4"></div>
			</div>
			<div class="ml-1 row align-items-center">
				<div class=" testimonial-wrap overflow-hidden">
					<div class="testimonial-block">
							<h4>Ben Williams</h4>
						<p>
							Diagnosed with Glioblastoma Multiforme in 1995 and given only a few months to live, Ben Williams refused to accept the dire prognosis. He aggressively pursued a combination of surgery, radiation, chemotherapy, and experimental treatments, becoming an advocate for innovative cancer therapies. His extensive research and determination have allowed him to survive for over two decades.
						</p>
						
					</div>
	
					<div class="testimonial-block">
							<h4>Cameron Mathison</h4>
						<p>
							In 2019, actor and television host Cameron Mathison was diagnosed with renal cell carcinoma that had metastasized to his brain. Despite the daunting diagnosis, Cameron underwent successful surgery followed by targeted therapy, all while maintaining a positive attitude and leaning on the support of his family and fans. Today, he is cancer-free and actively promotes cancer awareness and the importance of early detection.
						</p>
					</div>
	
					<div class="testimonial-block">
							<h4>Alexis</h4>
						<p>
							At age 4, Alexis was diagnosed with medulloblastoma and faced a rigorous treatment regimen that included surgery, radiation, and chemotherapy. Her family's blog documenting her journey highlighted her remarkable resilience and positive spirit. Now a healthy teenager, Alexis continues to inspire others with her story and advocacy for pediatric cancer research, providing hope and guidance to many others.
						</p>
					</div>
	
					<div class="testimonial-block">
							<h4>Jim Kelly</h4>
						<p>
							Hall of Fame NFL quarterback Jim Kelly was diagnosed with squamous cell carcinoma of the jaw in 2013, which later spread to his brain. Through multiple surgeries, chemotherapy, and radiation therapy, Jim relied on his faith and family for strength. Today, he is cancer-free and dedicates his efforts to raising awareness and funds for cancer research through his foundation, serving as a source of inspiration to many.
						</p>
					</div>
	
					<div class="testimonial-block">
							<h4>Liz Salmi</h4>
						<p>
							Liz Salmi was diagnosed with a grade II astrocytoma at 29 and underwent two brain surgeries and chemotherapy. She transformed her challenging experience into a mission to advocate for patient-centered care and transparency in medical records. Through her blog and public speaking, Liz provides valuable support and insights to other brain cancer patients, significantly impacting the approach to cancer care and treatment.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection

@section('js')
				<!-- Slick Slider -->
    <script src="{{asset('assets/frontend/plugins/slick-carousel/slick/slick.min.js')}}"></script>
@endsection