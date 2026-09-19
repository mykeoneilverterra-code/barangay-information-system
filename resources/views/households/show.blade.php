@extends('layouts.app')

@section('title', 'Household Details')

@section('content')

<div class="details-page">

    <div class="details-card">

        <div class="details-header">

            <div>

                <p class="records-eyebrow">
                    HOUSEHOLD PROFILE
                </p>

                <h2>
                    {{ $household->household_number }}
                </h2>

                <p>
                    Registered household information
                </p>

            </div>


            <div class="details-header-actions">

                <a
                    href="{{ route('households.edit', $household) }}"
                    class="secondary-action-btn"
                >
                    Edit Household
                </a>

                <a
                    href="{{ route('households.index') }}"
                    class="primary-action-btn"
                >
                    Back to Households
                </a>

            </div>

        </div>


        <div class="details-grid">

            <div class="detail-item">

                <span>
                    Household Head
                </span>

                <strong>
                    {{ $household->household_head }}
                </strong>

            </div>


            <div class="detail-item">

                <span>
                    Contact Number
                </span>

                <strong>
                    {{ $household->contact_number ?? 'Not provided' }}
                </strong>

            </div>


    <div class="card mb-4">
        <div class="card-body">

            <h4 class="card-title mb-3">
                {{ $household->household_number }}
            </h4>

            <p>
                <strong>Household Head:</strong>
                {{ $household->household_head }}
            </p>

            <p>
                <strong>Address:</strong>
                {{ $household->address }}
            </p>

            <p>
                <strong>Purok:</strong>
                {{ $household->purok }}
            </p>

            <p>
                <strong>Contact Number:</strong>
                {{ $household->contact_number ?? 'N/A' }}
            </p>

        </div>

    </div>


    <div class="details-card household-members-card">

        <div class="records-card-header">

            <div>

                <h3>
                    Household Members
                </h3>

                <p>
                    Residents registered under this household.
                </p>

            </div>


            <div class="member-count">

                <strong>
                    {{ $household->residents->count() }}
                </strong>

                <span>
                    Residents
                </span>

            </div>

        </div>

        <div class="card-body">

                    @forelse($household->residents as $resident)

                        <tr>

                            <td>
                                <span class="record-id">
                                    {{ $resident->resident_number }}
                                </span>
                            </td>

                            <td>

                                <div class="record-person">

                                    <div class="record-avatar">
                                        {{ strtoupper(substr($resident->first_name, 0, 1)) }}
                                    </div>

                                    <span>

                                        {{ $resident->full_name }}

                                        @if($resident->is_household_head)

                                            <span class="head-badge">
                                                Head
                                            </span>

                                        @endif

                                    </span>

                                </div>

                            </td>

                            <td>
                                {{ $resident->sex }}
                            </td>

                            <td>
                                {{ $resident->occupation ?? 'Not provided' }}
                            </td>

                            <td>

                                @if($resident->is_voter)

                                    <span class="voter-badge voter-yes">
                                        Registered
                                    </span>

                                @else

                                    <span class="voter-badge voter-no">
                                        No
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="records-empty"
                            >
                                No residents registered under this household.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection