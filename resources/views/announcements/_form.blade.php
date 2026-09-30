@php

    $categories = [
        'Community',
        'Youth',
        'Health',
        'Government',
        'Emergency',
        'Other',
    ];

    $statuses = [
        'Draft',
        'Published',
    ];

@endphp


<div class="announcement-form-grid">


    <div class="announcement-form-column">


        <div class="announcement-field">

            <label for="title">
                Title
                <span>*</span>
            </label>

            <input
                type="text"
                name="title"
                id="title"
                value="{{ old(
                    'title',
                    $announcement->title ?? ''
                ) }}"
                placeholder="Enter announcement title"
            >

            @error('title')
                <div class="announcement-field-error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <div class="announcement-field">

            <label for="category">
                Category
                <span>*</span>
            </label>

            <select
                name="category"
                id="category"
            >

                <option value="">
                    Select category
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category }}"
                        @selected(
                            old(
                                'category',
                                $announcement->category ?? ''
                            ) === $category
                        )
                    >
                        {{ $category }}
                    </option>

                @endforeach

            </select>

            @error('category')
                <div class="announcement-field-error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <div class="announcement-field">

            <label for="announcement_date">
                Announcement Date
                <span>*</span>
            </label>

            <input
                type="date"
                name="announcement_date"
                id="announcement_date"
                value="{{ old(
                    'announcement_date',
                    isset($announcement)
                    && $announcement->announcement_date
                        ? $announcement
                            ->announcement_date
                            ->format('Y-m-d')
                        : now(
                            'Asia/Manila'
                        )->format('Y-m-d')
                ) }}"
            >

            @error('announcement_date')
                <div class="announcement-field-error">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>


    <div class="announcement-form-column">


        <div class="announcement-field">

            <label for="description">
                Description
                <span>*</span>
            </label>

            <textarea
                name="description"
                id="description"
                maxlength="2000"
                placeholder="Enter announcement details..."
            >{{ old(
                'description',
                $announcement->description ?? ''
            ) }}</textarea>

            <div class="announcement-character-note">
                Maximum 2,000 characters
            </div>

            @error('description')
                <div class="announcement-field-error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <div class="announcement-field">

            <label for="status">
                Status
                <span>*</span>
            </label>

            <select
                name="status"
                id="status"
            >

                @foreach($statuses as $status)

                    <option
                        value="{{ $status }}"
                        @selected(
                            old(
                                'status',
                                $announcement->status
                                    ?? 'Published'
                            ) === $status
                        )
                    >
                        {{ $status }}
                    </option>

                @endforeach

            </select>

            @error('status')
                <div class="announcement-field-error">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>

</div>