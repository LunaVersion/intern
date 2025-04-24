const fruits = ["apple", "banana", "orange", "grape", "kiwi"];
function List() {
  return (
    <div>
      <h2>Fruits List</h2>
      <ul>
        {fruits.map((fruit, index) => (
            // key={index} là thuộc tính duy nhất cho mỗi phần tử trong danh sách
            // giúp theo dõi và tối ưu hóa việc render lại danh sách
          <li key={index}>{fruit}</li>
        ))}
      </ul>
    </div>
  );
}
export default List;