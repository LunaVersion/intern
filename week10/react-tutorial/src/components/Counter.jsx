import React, {Component} from 'react';

// Mount (constructor → render → componentDidMount)
// ↓
// Updating (shouldComponentUpdate → render → componentDidUpdate)
// ↓
// Unmount (componentWillUnmount)

class Counter extends Component {
    //constructor là nơi khởi tạo state và bind các phương thức
    constructor(props) {
        super(props); // luôn gọi super(props) khi có constructor để this.state hoạt động
        this.state = {
            count: 0 //state là cả đối tượng count:0, có thể thêm nhiều thuộc tính khác
        }; // số hiển thị sẽ lấy từ this.state.count
    };
    componentDidMount() {
        // gọi khi component đã được mount vào DOM, vd khi mới vào trang
        // có thể gọi API ở đây, ví dụ gọi API để lấy dữ liệu từ server
        console.log('Component đã được mount vào DOM');
    }
    componentWillUnmount() {
        console.log('Component sẽ bị xóa!'); // ví dụ khi chuyển trang thì sẽ log
    }
    // thêm nút tăng counter
    increase = () => {
        this.setState({ count: this.state.count + 1 });
    };
    decrease = () => {
        this.setState({ count: this.state.count - 1 });
    };
    render() {
        return (
            <div className="counter">
                {/* <h1> Đếm :0 </h1> */}
                <h1>Đếm: {this.state.count}</h1>
                {/* event handling*/}
                <button onClick={this.increase}>Tăng</button> 
                <button onClick={this.decrease}>giảm</button>
            </div>
        );
    }
}

export default Counter;