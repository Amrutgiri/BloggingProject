 <!-- horizontal Basic Forms Start -->
 <div class="pd-20 card-box mb-30">
     <div class="clearfix">
         <div class="pull-left">
             <h4 class="text-blue h4">Create Post</h4>

         </div>
         {{-- <div class="pull-right">
             <a href="#horizontal-basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                 data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source Code</a>
         </div> --}}
     </div>
     <form wire:submit="save">
         <div class="form-group">
             <label>Post Title *</label>
             <input class="form-control" wire:model="post_title" type="text" placeholder="Post Title" />
             @error('post_title')
                 <span class="text-danger" >
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
         </div>

         <div class="form-group">
             <label>Post Content</label>
             <textarea class="form-control" wire:model="content" placeholder="Post Content"></textarea>
             @error('content')
                 <span class="text-danger">
                     <strong>{{ $message }}</strong>
                 </span>
             @enderror
         </div>

         {{-- <div class="form-group">
             <label>Upload Image</label>
             <div class="custom-file">
                 <input type="file" class="custom-file-input" />
                 <label class="custom-file-label">Choose file</label>
             </div>
         </div> --}}

         <button type="submit" class="btn btn-primary">Submit</button>
         <a href="/user/home" wire:navigate class="btn btn-secondary">Cancel</a>
     </form>

 </div>
