import React from "react";
import { Form, Modal, Spin } from "antd";

export const ModalForm = (props) => {
  // const [form] = Form.useForm();
  const { form } = props;

  const formItemLayout =
    props.formLayout === "horizontal"
      ? {
          labelCol: { span: 8 },
          wrapperCol: { span: 16 },
        }
      : null;

  return (
    <Modal
      visible={props.visible}
      title={props.title}
      okText={props.okText ?? "Submit"}
      cancelText={props.cancelText ?? "Cancel"}
      onCancel={props.onCancel}
      confirmLoading={props.confirmLoading}
      onOk={() => {
        form
          .validateFields()
          .then((values) => {
            props.onCreate(values);
          })
          .catch((info) => {
            console.log("Validate failed: ", info);
          });
      }}
    >
      <Spin spinning={props.formLoading ?? false}>
        <Form
          {...formItemLayout}
          form={form}
          layout={props.formLayout ?? "vertical"}
          name={props.formName}
          onFieldsChange={props.onFieldsChange}
          onValuesChange={props.onValuesChange}
        >
          {props.children}
        </Form>
      </Spin>
    </Modal>
  );
};
