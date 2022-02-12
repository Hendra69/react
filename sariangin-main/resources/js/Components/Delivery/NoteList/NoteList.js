import React from "react";
import { List } from "antd";
import dayjs from "dayjs";

export const NoteList = ({ notes, title }) => {
  return (
    <React.Fragment>
      <h5>{title}</h5>
      <List
        bordered
        itemLayout="horizontal"
        dataSource={notes}
        renderItem={(item) => (
          <List.Item key={item.id}>
            <List.Item.Meta
              title={
                item.user_name +
                " (" +
                item.user_role +
                ") - " +
                dayjs(item.created_at).format("DD/MM/YYYY HH:mm")
              }
              description={item.note}
            />
          </List.Item>
        )}
      />
    </React.Fragment>
  );
};
