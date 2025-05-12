import React from "react";
function Search({ searchTerm, onSearch }) {
    return (
        <div className="search-container" >
            <input
                type="text"
                placeholder="Tìm kiếm nhân viên theo tên, năm sinh, địa chỉ..."
                value={searchTerm}
                onChange={(e) => onSearch(e.target.value)}
                style={{ width: "100%", padding: "10px", borderRadius: "5px", border: "1px solid #ccc" }}
            />
        </div>
    );
}
export default Search;