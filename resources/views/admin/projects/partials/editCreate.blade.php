<form action="{{ route($routeName, $project) }}" method="POST" class="p-5" enctype="multipart/form-data">
    @csrf
    @method($method)

    @if($errors->any())
    <div class="error-wrapper">
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <h5 class="mb-3">
        Author: <span class="fw-semibold">{{ Auth::user()->name }} </span>
    </h5>

    <div class="mb-3">
        <label for="project_title" class="form-label">
            Project title
        </label>
        <input type="text" class="form-control" id="project_title" placeholder="Insert Project's title" name="title" value="{{ old('title', $project->title) }}">
    </div>

    <select class="form-control mb-3" id="project_type" name="type_id" >
        @foreach ($types as $type)
            <option value="{{ $type->id }}"
                {{ old('type_id', $project->type_id) ==  $type->id ? 'selected' : '' }}> {{ $type->name }}
            </option>
        @endforeach
    </select>
    <div class="d-flex align-items-center mb-3">
        @foreach ($technologies as $technology)
            <div class="single-technology d-flex align-items-center">
                <input type="checkbox" class="form-check-input p-2 ms-2" name="technologies[]" value="{{ $technology->id }}"

                @if ($errors->any())
                    @checked(in_array($technology->id, old('technologies',[])))
                @else
                    @checked($project->technologies->contains($technology->id))
                @endif
                >

                <label class="form-check-label ms-2">{{ $technology->name }}</label>
            </div>
        @endforeach
    </div>

    <div class="mb-3">
        <label for="project_date" class="form-label">Project date</label>
        <input type="date" class="form-control" id="project_date" name="project_date" value="{{ old('project_date', $project->project_date) }}">
    </div>

    <div class="mb-3">
        <label for="project_content" class="form-label">Project content</label>
        <textarea class="form-control" id="project_content" rows="5" name="content">{{ old('content', $project->content) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="project_image" class="form-label">Project image</label>
        <input type="file" class="form-control" id="project_image" name="image" value="{{ old('image', $project->image) }}">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            {{ $routeName == 'admin.projects.update' ? 'Update project' : 'Create new project'  }}
        </button>
    </div>

    </div>
</form>