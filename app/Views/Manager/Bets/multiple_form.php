<div class="row">
    <div class="col-md-8 mb-3">
        <label class="form-label" for="selection">Selection</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-football"></i></span>
            <input
                type="text"
                id="selection"
                name="selection"
                class="form-control"
            />
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="odd" class="form-label">Odd</label>
        <div class="input-group input-group-merge">
            <input 
                type="text" 
                id="odd"
                name="odd"
                class="form-control"
                value=""
            />
        </div>
    </div>

    <div class="col-md-8 mb-3">
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-football"></i></span>
            <input
                type="text"
                id="selection"
                name="selection"
                class="form-control"
            />
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="input-group input-group-merge">
            <input 
                type="text" 
                id="odd"
                name="odd"
                class="form-control"
                value=""
            />
        </div>
    </div>

    <div class="col-md-8 mb-3">
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-football"></i></span>
            <input
                type="text"
                id="selection"
                name="selection"
                class="form-control"
            />
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="input-group input-group-merge">
            <input 
                type="text" 
                id="odd"
                name="odd"
                class="form-control"
                value=""
            />
        </div>
    </div>
    
    <div class="col-md-12 mb-3">
        <label class="form-label" for="description">Description</label>
        <div class="input-group input-group-merge">
            <span class="input-group-text"><i class="bx bx-pencil"></i></span>
            <input
                type="text"
                id="description"
                name="description"
                class="form-control"
            />
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="bankroll" class="form-label">Bankroll</label>
        <select class="form-select" id="bankroll" aria-label="My Bankroll">
            <option value="1">My Bankroll</option>
        </select>
    </div>
    
    <div class="col-md-6 mb-3">
        <label for="date" class="col-md-2 col-form-label">Date</label>
        <input
        class="form-control"
        type="datetime"
        value="2021-06-18"
        id="html5-datetime-local-input"
        />
    </div>

    <div class="col-md-6 mb-3">
        <label for="stake" class="form-label">Stake</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-dollar"></i>
            </span>
            <input 
                type="text" 
                id="stake"
                name="stake"
                class="form-control money"
                value=""
            />
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="result" class="form-label">Result</label>
        <div class="input-group input-group-merge">
            <span id="icon-name" class="input-group-text">
                <i class="bx bx-dollar"></i>
            </span>
            <input 
                type="text" 
                id="result"
                name="result"
                class="form-control money"
                value=""
            />
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <label for="justification" class="form-label">Justification</label>
        <textarea class="form-control" id="justification" rows="3"></textarea>
    </div>

    <div class="col-md-12 mb-3">
        <label for="tags" class="form-label">Tags</label>
        <select class="form-select" id="tags" aria-label="Tags">
            <option value="1">The list is empty</option>
        </select>
    </div>

    <div class="col-md-12 mb-3">
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="pending" value="0" />
            <input type="checkbox" class="form-check-input" name="pending" id="pending" value="1" />
            <label class="form-label" for="pending">Save as pending bet</label>
        </div>
    </div>
</div>
