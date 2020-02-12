<?php

?>
<div class="modal fade" id="addAnimeModal" tabindex="-1" role="dialog" aria-labelledby="addAnimeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bchan-header-add">
                <h5 class="modal-title" id="addAnimeModal">Add Anime</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" action="/list">

                    <label for="anime_name">Name</label>
                    <input type="text" name="anime_name" class="form-control" placeholder="Name">

                    <label for="anime_episodes">Type</label>
                    <input type="text" name="aniem_episodes" class="form-control" placeholder="Type">

                    <label for="anime_status">Status</label>
                    <input type="text" name="anime_status" class="form-control" placeholder="Status">

                    <label for="anime_aired">Aired</label>
                    <input type="text" name="anime_aired" class="form-control" placeholder="Aired">

                    <label for="anime_premiered">Premiered</label>
                    <input type="text" name="anime_premiered" class="form-control" placeholder="Premiered">

                    <label for="anime_broadcast">Broadcast</label>
                    <input type="text" name="anime_broadcast" class="form-control" placeholder="Broadcast">

                    <label for="anime_producers">Producers</label>
                    <input type="text" name="anime_producers" class="form-control" placeholder="Producers">

                    <label for="anime_studios">Studios</label>
                    <input type="text" name="anime_studios" class="form-control" placeholder="Studios">

                    <label for="anime_source">Source</label>
                    <input type="text" name="anime_source" class="form-control" placeholder="Source">

                    <label for="anime_genres">Genres</label>
                    <input type="text" name="anime_genres" class="form-control" placeholder="Genres, separate with coma">

                    <label for="anime_duration">Duration</label>
                    <input type="text" name="anime_duration" class="form-control" placeholder="Duration">

                    <label for="anime_rating">Rating</label>
                    <input type="text" name="anime_rating" class="form-control" placeholder="Rating">

                    <label for="anime_synopsys">Synopsis</label>
                    <textarea id="bchan_description" name="anime_synopsis" class="form-control" placeholder="Synopsis"></textarea>

                    <label for="anime_name">Picture</label>
                    <input type="file" name="anime_pictures" class="form-control">

                    <input type="button" class="mt-3 btn btn-success btn-sm" name="anime_save" value="Publish">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
                            