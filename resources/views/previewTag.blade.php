<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> -->
<input type="hidden" id="userId" value="{{$tag->userId}}" />
<input type="hidden" id="tagId" value="{{$tag->id}}" />
<input type="hidden" id="tagCategory" value="{{$tag->category}}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script> 
    <title>Document</title>
    <style>
        .controls-container {
            position: absolute;
            bottom: 0;
            left: 10%;
            transform: translateX(-50%);
        }
    </style>
</head>

<?php

        $data=[
            'luggageContact' => '/images/luggageContact.png',
            'luggageBrand' => '/images/luggageBrand.png',
            'luggageType' => '/images/luggageType.png',
            'luggageFontColor' => 'rgba(73, 255, 211, 1)',
            'luggageRewardImage' => '/images/luggageRewardImage.png',

            'kidContact' => '/images/kidContact.png',
            'kidHeight' => '/images/kidheight.png',
            'kidDress' => '/images/dressColor.png',
            'kidFontColor' => 'rgba(255, 196, 0, 1)',
            'kidRewardImage' => '/images/kidReward.png',

            'petContact' => '/images/petContact.png',
            'petFontColor' => 'rgba(252, 26, 64, 1)',
            'petRewardImage' => '/images/petRewardImage.png',
        ];

?>


<body>
    <div class="logo">
        <img src="/images/Tapz.png" alt="">
    </div>

    <div class="slider-container">
        
        <div class="slider">
        @foreach($images as $image)


    
    <div class="slide"><img src="/{{ $image->path }}" alt="Image"></div>
  @endforeach
          <!-- <div class="slide"><img src="/images/image.png" alt="Slide 1"></div>
          <div class="slide"><img src="/images/image.png" alt="Slide 1"></div>
          <div class="slide"><img src="/images/image.png" alt="Slide 1"></div> -->
        </div>
        
      
  <div class="controls">
    <div class="control-btn" onclick="prevSlide()">&#10094;</div>
    <div class="control-btn" onclick="nextSlide()">&#10095;</div>
  </div>
  <div class="slider-indicator"></div>
</div>


    <div style="margin-top:10px;">
        <div style="padding-left:10px;">
            <h1 style="display: inline-block;">
            @if($tag->category === 'kid' || $tag->category === 'pet')
            {{ ucfirst($tag->name) }}
            @else
            Luggage
            @endif
            </h1>
            <p style="display: inline-block; margin-right: 10px;font-size:16px;font-weight:600;color:gray;">(
                @if($tag->category === 'kid' || $tag->category === 'pet')
                {{ ucfirst($tag->gender) }}
                @else
                {{$tag->luggageType}}
                @endif
                
            ) 
            <div id="locationButton"  class="shareBox1" style="cursor:pointer;" onclick="getLocation()">
             <img src="/images/share-location.png" alt="" style="margin-top:2px;padding:0;">
             <p style=" margin:0;margin-top:-5px;display: inline-block; font-size:12px;font-weight:400;color:gray;vertical-align:middle;">Location</p>
            </div>

           <div class="share-box2" style="margin-right:-78px;cursor:pointer;" onclick="openModal()">
    <img src="/images/share-location.png" alt="" style="padding:0;vertical-align:middle;">
    <p style="" class="share-text">Contact</p>
</div>
            </p> 

<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>

       <div class="modal-image">
        <img src="/{{ $image->path }}" alt="">
       </div>
       <div class="form_contact_info">
                <form action="" id="Form">



<p style="margin-left:15px; color:red;" id="ErrorMessage"></p>

<input type="text" id="id" name="id" value="sZaU9zFpxPXeipu8E62UWmq7Rfo2" hidden>

<label class="input_label" for="name">Full Name</label>
<input type="text" class="input_field" name="name" id="name" placeholder="Enter Name" required>

<label class="input_label" for="email">Email</label>
<input type="email" class="input_field" name="email" id="email" placeholder="Enter Email" required>

<label class="input_label" for="phone">Phone Number</label>
<input type="tel" class="input_field" name="phone" id="phone" placeholder="Enter Mobile Number" pattern="[0-9+]+" title="Phone number should contain only numbers and the plus sign (+)." required>


<label class="input_label" for="message">Message</label>
<textarea type="text" class="input_field" name="message" id="message" placeholder="Write Message" style="min-height:100px; max-width:94%; min-width:94%" required></textarea>

                <input type="hidden" name="" value="{{$tag->id}}">
<input type="submit" class="submit" id="submit"  value="Share Contact">
                </form>
    </div>
</div>
        </div>

        <div>
                @if($tag->category === 'luggage')
                 <img src="{{asset($data['luggageContact'])}}" alt="" style="vertical-align: middle;">
                 @elseif($tag->category === 'kid')
                 <img src="{{asset($data['kidContact'])}}" alt=""  style="vertical-align: middle;">
                 @else
                 <img src="{{asset($data['petContact'])}}" alt=""  style="vertical-align: middle;"> 
                @endif 
            
            <p style="margin-top: -10px;display: inline-block;margin-left:6px;font-size:12px;font-weight:400;color:gray;">
            @if($tag->category === 'pet' || $tag->category === 'luggage')
            {{ucfirst($tag->ownerName)}}
            @else
            {{ucfirst($tag->fatherName)}}
            @endif
            </p>
            
   

        </div>
             
        <div style="display: flex; align-items: flex-start;">
                <div style="margin-right: 10px;">
                  <img src="/images/location.png" alt="">
                </div>
              <div style="flex-grow: 1;">
                <p style="margin:0;margin-top:4px;font-size:12px;font-weight:500;color:gray;word-wrap:break-word;max-width: 180px;">{{$tag->address}}</p>
               </div>
        </div>

    </div>

    <div class="info-tags">

        <div class="tag">
            @if($tag->category === 'pet' || $tag->category === 'kid')
            <img src="/images/heart.png" alt="">
            @else
            <img src="{{asset($data['luggageBrand'])}}" alt="">
            @endif

            <p class="tag-heading">
            @if($tag->category === 'kid' || $tag->category === 'pet')
                Gender
            @else
            Brand
            @endif 
            </p>
            <p class="tag-value">
                @if($tag->category === 'kid' || $tag->category === 'pet')
                {{ $tag->gender }}
            @else
            {{ $tag->brand }}
            @endif 
            </p>
        </div>

        <div class="tag">
            @if($tag->category === 'kid' || $tag->category === 'pet')
            <img src="/images/age.png" alt="">
            @else
            <img src="{{asset($data['luggageType'])}}" alt="">
            @endif
            <p class="tag-heading">
                @if($tag->category === 'kid' || $tag->category === 'pet') 
                Age
                @else
                Type
                @endif
            </p>
            <p class="tag-value">
                @if($tag->category === 'kid' || $tag->category === 'pet') 
                {{ $tag->age }}
                @elseif($tag->category === 'luggage')
                {{ $tag->luggageType }}
                @endif
            </p>
        </div>

        @if($tag->category === 'kid' || $tag->category === 'pet')
         <div class="tag">
            @if($tag->category === 'pet')
             <img src="/images/weight.png" alt="">
            @elseif($tag->category === 'kid')
             <img src="/images/height.png" alt="">
            @endif
            <p  class="tag-heading"  >
            
            
                @if($tag->category === 'kid') 
                 Height 
                 @elseif($tag->category === 'pet')
                 Weight
                @endif
            </p>
            <p class="tag-value">
                @if($tag->category === 'kid') 
                 {{ $tag->height}} Feet
                 @elseif($tag->category === 'pet')
                 {{ $tag->weight}}
                @endif
            </p>
         </div>
        @endif

        <div class="tag">
            @if($tag->category === 'pet' || $tag->category === 'luggage')
            <img src="/images/color.png" alt="">
            @elseif($tag->category === 'kid')
            <img src="/images/dressColor.png" alt="">
            @endif

            @if($tag->category === 'pet' || $tag->category === 'luggage')
            <p  class="tag-heading">Color</p>
            @elseif($tag->category  === 'kid')
            <p class="tag-heading">Dress Color</p>
            @endif

            @if($tag->category === 'pet' || $tag->category === 'luggage')
            <p class="tag-value">{{ $tag->color }}</p>
            @elseif($tag->category === 'kid')
            <p class="tag-value">{{ $tag->dressColor }}</p>
            @endif
        </div>


    </div>

 

    <div class="reward-tag" style="">
        <div style="display: flex; align-items: center;">
            @if($tag->category === 'luggage')
             <img src="{{asset($data['luggageRewardImage'])}}" alt="" style="margin-right: 5px; height: 60px; width: 60px;"> 
            @elseif($tag->category === 'kid')
             <img src="{{asset($data['kidRewardImage'])}}" alt="" style="margin-right: 5px; height: 60px; width: 60px;"> 
            @else
             <img src="{{asset($data['petRewardImage'])}}" alt="" style="margin-right: 5px; height: 60px; width: 60px;">
            @endif 
            <div style="margin-top: 8px;">
                @if($tag->category === 'luggage')
                <p  style="margin:0;font-size:16px;font-weight:700;color:{{$data['luggageFontColor']}};">Reward</p>
                <p style="font-size: 14px; line-height: 1.2;word-wrap:break-word; margin-top:3px;">A reward of <span style="color:{{$data['luggageFontColor']}};font-weight:600;">${{ $tag->reward }}</span> will be given to<br> whoever finds the luggage.</p>
                @elseif($tag->category === 'kid')
                <p  style="margin:0;font-size:18px;font-weight:700;color:{{$data['kidFontColor']}};">Reward</p>
                <p style="font-size: 14px; line-height: 1.2;word-wrap:break-word; margin-top:3px;">A reward of <span style="color:{{$data['kidFontColor']}};font-weight:600;">${{ $tag->reward }}</span> will be given to<br> whoever finds the kid.</p>
                @else
                <p  style="margin:0;font-size:18px;font-weight:700;color:{{$data['petFontColor']}};">Reward</p>
                <p style="font-size: 14px; line-height: 1.2; word-wrap: normal; margin-top: 3px;">
    A reward of <span style="color: {{ $data['petFontColor'] }}; font-weight: 600;">${{ $tag->reward }}</span> will be given to whoever finds the pet.
</p>
                @endif
            </div>
        </div>
        <div>
            @if($tag->category === 'luggage')
            <p style="margin:0;margin-left:10px;font-size:30px;font-weight:700;color:{{$data['luggageFontColor']}};padding-right :20px;">${{ $tag->reward }}</p>
            @elseif($tag->category === 'kid')
            <p style="margin:0;margin-left:10px;font-size:30px;font-weight:700;color:{{$data['kidFontColor']}};padding-right :20px;">${{ $tag->reward }}</p>
            @else
            <p style="margin:0;margin-left:10px;font-size:30px;font-weight:700;color:red;padding-right :20px;">${{ $tag->reward }}</p>
            @endif
        </div>
    </div>

    <div class="additional-info">
    <div class="grid">
    <div>
        <p class="heading" style="font-weight: 500;padding-left:10px;">Mobile Number</p>
        <p class="additional-info-value">{{$tag->mobileNumber}}</p>
    </div>
   
    <div>
        <p class="heading" style="font-weight: 500;padding-left:10px;">Secondary Number</p>
        @if(!empty($tag->mobileNumber2))
        <p class="additional-info-value">{{$tag->mobileNumber2}}</p>
        @else
        <p class="additional-info-value">N/A</p>
        @endif
    </div>
   
    <div>
        <p class="heading" style="font-weight: 500;padding-left:10px;">Contact Email</p>
        <p class="additional-info-value">{{$tag->contactEmail}}</p>
    </div>
 
</div>
        <!-- <div style="" class="grid">
            <div>
                <p style=" margin:0;font-size:16px;font-weight:600;">Mobile Number</p>
                <p  style=" margin:0;font-size:14px;font-weight:500;color:gray;">{{$tag->mobileNumber}}</p>
            </div>
            <div>
                <p style=" margin:0;font-size:16px;font-weight:600;">Secondary Number</p>
                <p  style=" margin:0;font-size:14px;font-weight:500;color:gray">{{$tag->mobileNumber2}}</p>
            </div>
            <div>
                <p style=" margin:0;font-size:16px;font-weight:600;">Contact Email</p>
                <p  style=" margin:0;font-size:14px;font-weight:500;color:gray">{{ $tag->contactEmail }}</p>
            </div>
            <div>
                <p style=" margin:0;font-size:16px;font-weight:600;">Address</p>
                <p  style=" margin:0;font-size:14px;font-weight:500;color:gray">{{$tag->address}}</p>
            </div>
        </div> -->

        <div>
        <p class="heading" style="font-weight: 500;margin-top:24px;margin-bottom:3px;padding-left:10px;">Address</p>
        <p class="additional-info-value">{{$tag->address}}</p>
    </div>

        @if($tag->category === 'pet')
        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:3px;font-size:16px;font-weight:500;padding-left:10px;">Vet Details</p>
            <p class="additional-info-value">{{$tag->vetDetail}}</p>
        </div>
        @elseif($tag->category === 'kid')
        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:3px;font-size:16px;font-weight:500;padding-left:10px;">Doctor Detail</p>
            <p class="additional-info-value">{{$tag->doctorDetail}}</p>
        </div>

        @endif

        @if($tag->category === 'pet' || $tag->category === 'kid')

        <div style="margin-top:5px ">
            <p  style=" margin:0;margin-top:24px;margin-bottom:3px;font-size:16px;font-weight:500;padding-left:10px;;">Medical Issue</p>
            <p class="additional-info-value">{{$tag->medicalIssue}}</p>
        </div>

        @endif

        @if(!empty($tag->note))
    <div style="margin-top: 5px;">
        <p style="margin: 0; margin-top: 24px; margin-bottom: 3px; font-size: 16px; font-weight: 500;padding-left:10px;">Note</p>
        <p style="font-size: 12px; text-align: justify; color: gray; margin-top: 2px;padding-left:10px;padding-right:10px;">{{ $tag->note }}</p>
    </div>
      @endif
</div>
    <script>
  let slideIndex = 0;
  let slideInterval;

  function showSlides() {
    const slider = document.querySelector('.slider');
    const slideWidth = slider.clientWidth;
    const numSlides = slider.children.length;
    
    // Ensure slideIndex stays within valid range
    slideIndex = (slideIndex + numSlides) % numSlides;
    
    slider.style.transform = `translateX(-${slideIndex * slideWidth}px)`;

    // Update slider indicator
    const indicatorDots = document.querySelectorAll('.indicator-dot');
    indicatorDots.forEach(dot => dot.classList.remove('active'));
    indicatorDots[slideIndex].classList.add('active');
  }

  function nextSlide() {
    slideIndex++;
    showSlides();
  }

  function prevSlide() {
    slideIndex--;
    showSlides();
  }

  // Create slider indicator dots
  const slider = document.querySelector('.slider');
  const numSlides = slider.children.length;
  const indicatorContainer = document.querySelector('.slider-indicator');
  for (let i = 0; i < numSlides; i++) {
    const dot = document.createElement('div');
    dot.classList.add('indicator-dot');
    if (i === 0) {
      dot.classList.add('active');
    }
    dot.addEventListener('click', () => {
      slideIndex = i;
      showSlides();
    });
    indicatorContainer.appendChild(dot);
  }

  
  function startAutoScroll() {
    slideInterval = setInterval(nextSlide, 3000);
  }

  // Function to stop auto-scrolling
  function stopAutoScroll() {
    clearInterval(slideInterval);
  }

  // Start auto-scrolling when the page loads
  startAutoScroll();
</script>

    
</body>

</html>